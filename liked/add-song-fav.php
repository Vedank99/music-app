<?php

  include '../config.php';
  error_reporting(0);

  session_start();

  $output = '';
  $username = $_SESSION['user'];
  $usr_id = $_SESSION['user_id'];


  if(isset($_POST['songBtn'])){
    $str = $_POST['searchSong'];

    $sql = "SELECT * FROM songs WHERE song_nm='$str' AND sng_id NOT IN (SELECT sng_id FROM user_songs WHERE usr_id='$usr_id')";
    $result = mysqli_query($conn,$sql);

    if($result->num_rows > 0){


      $output .= '<div>Check the songs which you want to add to favourites</div>';
      $output .= '<form method="POST">';
      while ($row = mysqli_fetch_assoc($result)){

        $output .= '<div class="container bg-light">
                      <input type="checkbox" name="songResults[]" value="'.$row['sng_id'].'" />
                      <span>'.$row['song_nm'].'</span>
                    </div>';
      }

      $output .= '<button name="songResBtn">Add</button>';
      $output .= '</form>';

    }else{
      $output .= '<div>There are no songs with this name</div>';
    }
    unset($_POST['songBtn']);
  }

  if(isset($_POST['songResBtn'])){

    $songResults = $_POST['songResults'];
    if(empty($songResults)){
      $output .="<div>You didn't select any songs.</div>";
    }else{
      $N = count($songResults);
      for($i=0; $i < $N; $i++){
        $sql = "INSERT INTO user_songs (usr_id,sng_id)
                VALUES ('$usr_id','$songResults[$i]')";
        $result = mysqli_query($conn,$sql);
        if(!$result){
          break;
        }
      }
      if(!$result){
        $output .= '<div>Some error occured '.mysqli_error($conn).'</div>';
      }else{
        $output .= '<div>Songs added successfully</div>';
      }
    }
    unset($_POST['songResBtn']);
  }

  if(isset($_POST['doneBtn'])){
    header('Location: favs.php');
    exit();
  }

?>


<!DOCTYPE html>
<html lang="en">
<?php include('../templates/header.php'); ?>
    <div>
      <form method="POST">
        <input class="form-control me-2" name="searchSong" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" name="songBtn" type="submit">Search</button>
      </form>
    </div>
    <?php echo $output; ?>
    <form method="POST">
      <div class="input-group">
        <button name="doneBtn" class="btn">Done</button>
      </div>
    </form>
    <?php include('../templates/footer.php'); ?>
</html>
