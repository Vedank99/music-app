<?php

  include 'config.php';
  error_reporting(0);

  session_start();

  $output = '';
  $username = $_SESSION['user'];
  $usr_id = $_SESSION['user_id'];

  $sql = "SELECT * FROM user_albums WHERE usr_id='$usr_id'";
  $result = mysqli_query($conn,$sql);

  if($result->num_rows > 0){
    $output .= '<div>Check the albums you want to remove from favourites and press Remove.</div>';
    $output .= '<form method="POST">';
    while ($row = mysqli_fetch_assoc($result)){

      $alb_id = $row['alb_id'];

      $sql = "SELECT * FROM albums WHERE alb_id='$alb_id'";
      $albRes = mysqli_query($conn,$sql);
      $albRow =  mysqli_fetch_assoc($albRes);

      $album_nm = $albRow['alb_name'];

      $output .= '<div class="container bg-light">
                    <input type="checkbox" name="favAlbums[]" value="'.$alb_id.'" />
                    <span>'.$album_nm.'</span>
                  </div>';
    }

    $output .= '<button name="albumRemBtn">Remove</button>';
    $output .= '</form>';

  }else{
      $output .= '<div>You have no favourite albums.</div>';
  }

  if(isset($_POST['albumRemBtn'])){

    $favAlbums = $_POST['favAlbums'];
    if(empty($favAlbums)){
      $output .="<div>You didn't select any albums.</div>";
    }else{
      $N = count($favAlbums);
      echo '<div>You selected'.$N.' album(s): <div>';
      for($i=0; $i < $N; $i++){
        $sql = "DELETE FROM user_albums WHERE alb_id='$favAlbums[$i]'";
        $result = mysqli_query($conn,$sql);
        if(!$result){
          break;
        }
      }
      if(!$result){
        $output .= '<div>Some error occured : '.mysqli_error($conn).'</div>';
      }else{
        header('Location: rem-album-fav.php');
        exit();
      }
    }
    unset($_POST['albumRemBtn']);
  }

  if(isset($_POST['doneBtn'])){
    header('Location: favs.php');
    exit();
  }

?>


<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php'); ?>
    <?php echo $output; ?>
    <form method="POST">
      <div class="input-group">
        <button name="doneBtn" class="btn">Done</button>
      </div>
    </form>
    <?php include('templates/footer.php'); ?>
</html>
