<?php

  include 'config.php';
  error_reporting(0);

  session_start();

  $alb_id = $_GET['alb_id'];
  $alb_name = $_GET['alb_name'];
  $sql = "SELECT * FROM alb_songs WHERE alb_id='$alb_id'";
  $result = mysqli_query($conn,$sql);
  $albOutput = '';

  if($result->num_rows > 0){

      while ($row = mysqli_fetch_assoc($result)) {

        $song_num = $row['sng_id'];

        $sql = "SELECT * FROM songs WHERE sng_id='$song_num'";
        $songResult = mysqli_query($conn,$sql);

        $songRow = mysqli_fetch_assoc($songResult);

        $albOutput .= '<div>
                        <a href="song.php?sng_id='. $song_num .'">'.$songRow['song_nm'].'</a>
                      </div>';
      }
  }else{
    $albOutput .= 'Oops, there are no songs in this Album.';
  }

?>

<!DOCTYPE html>
<html>
  <?php include('templates/header.php'); ?>
  <?php echo $albOutput; ?>
  <?php include('templates/footer.php'); ?>
</html>
