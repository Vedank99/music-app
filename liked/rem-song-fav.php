<?php

  include '../config.php';
  error_reporting(0);

  session_start();

  $output = '';
  $username = $_SESSION['user'];
  $usr_id = $_SESSION['user_id'];

  $sql = "SELECT * FROM user_songs WHERE usr_id='$usr_id'";
  $result = mysqli_query($conn,$sql);

  if($result->num_rows > 0){
    $output .= '<div>Check the songs you want to remove from favourites and press Remove.</div>';
    $output .= '<form method="POST">';
    while ($row = mysqli_fetch_assoc($result)){

      $sng_id = $row['sng_id'];

      $sql = "SELECT * FROM songs WHERE sng_id='$sng_id'";
      $sngRes = mysqli_query($conn,$sql);
      $sngRow =  mysqli_fetch_assoc($sngRes);

      $song_nm = $sngRow['song_nm'];

      $output .= '<div class="container bg-light">
                    <input type="checkbox" name="favSongs[]" value="'.$sng_id.'" />
                    <span>'.$song_nm.'</span>
                  </div>';
    }

    $output .= '<button name="songRemBtn">Remove</button>';
    $output .= '</form>';

  }else{
    $output .= '<div>You have no songs in this playlist</div>';
  }

  if(isset($_POST['songRemBtn'])){

    $favSongs = $_POST['favSongs'];
    if(empty($favSongs)){
      $output .="<div>You didn't select any songs.</div>";
    }else{
      $N = count($favSongs);
      echo '<div>You selected'.$N.' song(s): <div>';
      for($i=0; $i < $N; $i++){
        $sql = "DELETE FROM user_songs WHERE sng_id='$favSongs[$i]'";
        $result = mysqli_query($conn,$sql);
        if(!$result){
          break;
        }
      }
      if(!$result){
        $output .= '<div>Some error occured : '.mysqli_error($conn).'</div>';
      }else{
        header('Location: rem-song-fav.php');
        exit();
      }
    }
    unset($_POST['songRemBtn']);
  }

  if(isset($_POST['doneBtn'])){
    header('Location: favs.php');
    exit();
  }

?>


<!DOCTYPE html>
<html lang="en">
<?php include('../templates/header.php'); ?>
    <?php echo $output; ?>
    <form method="POST">
      <div class="input-group">
        <button name="doneBtn" class="btn">Done</button>
      </div>
    </form>
    <?php include('../templates/footer.php'); ?>
</html>
