<?php

  include 'config.php';
  error_reporting(0);

  session_start();

  $lang_id = $_GET['lang_id'];
  $sql = "SELECT * FROM song_langs WHERE lang_id='$lang_id'";
  $result = mysqli_query($conn,$sql);
  $langSongsOutput = '';

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
    $genSongsOutput .= 'Oops, there are no songs of this language.';
  }


?>

<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>
<?php echo $genSongsOutput; ?>
<?php include('templates/footer.php'); ?>
</html>
