<?php

  include 'config.php';
  error_reporting(0);

  session_start();

  if (!isset($_SESSION['user'])) {
      header("Location: index.php");
  }

  $songsOutput = '';
  $albumsOutput = '';
  $username = $_SESSION['user'];

  $sql = "SELECT * FROM users WHERE username='$username'";
  $result = mysqli_query($conn,$sql);

  if($result->num_rows > 0){
    $row = mysqli_fetch_assoc($result);
    $usr_id = $row['usr_id'];
    $sql = "SELECT * FROM songs WHERE usr_id='$usr_id'";
    $result = mysqli_query($conn,$sql);

      if($result->num_rows > 0){
          while ($row = mysqli_fetch_assoc($result)) {
            $songsOutput .= '<div>
                          <a href="song.php?sng_id='. $row['sng_id'] .'">'.$row['song_nm'].'</a>
                        </div>';
          }
      }else{
        $songsOutput = '<div>No songs uploaded</div>';
      }

      $sql = "SELECT * FROM albums WHERE usr_id='$usr_id'";
      $result = mysqli_query($conn,$sql);

      if($result->num_rows > 0){
          while ($row = mysqli_fetch_assoc($result)) {
            $alb_id = $row['alb_id'];
            $alb_name = $row['alb_name'];
            $albumsOutput .= '<div>
                              <a href="album.php?alb_id='.$alb_id.'&alb_name='.$alb_name.'">'.$alb_name.'</a>
                            </div>';
          }
      }else{
        $albumsOutput = '<div>No albums created</div>';
      }


  }else{
    echo "Some error occured. Please go back.";
  }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <?php include('templates/header-profile.php'); ?>
  <div>My Songs</div>
  <?php print("$songsOutput")?>
  <div>My Albums</div>
  <?php print("$albumsOutput")?>
  <?php include('templates/footer.php'); ?>
</html>
