<?php

  include 'config.php';
  error_reporting(0);

  session_start();

  $gen_id = $_GET['gen_id'];
  $sql = "SELECT * FROM song_gens WHERE gen_id='$gen_id'";
  $result = mysqli_query($conn,$sql);
  $genSongsOutput = '';

  if($result->num_rows > 0){
      while ($row = mysqli_fetch_assoc($result)) {

        $song_num = $row['sng_id'];

        $sql = "SELECT * FROM songs WHERE sng_id='$song_num'";
        $songResult = mysqli_query($conn,$sql);

        $songRow = mysqli_fetch_assoc($songResult);

        $genSongsOutput .= '<div>
                              <a href="song.php?sng_id='. $song_num .'">'.$songRow['song_nm'].'</a>
                            </div>';
      }
  }else{
    $genSongsOutput .= 'Oops, there are no songs of this genre.';
  }


?>

<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>
<?php echo $genSongsOutput; ?>
<?php include('templates/footer.php'); ?>
</html>
