<?php

  include 'config.php';
  error_reporting(0);

  session_start();

  $ply_id = $_GET['ply_id'];
  $ply_name = $_GET['ply_name'];
  $sql = "SELECT * FROM ply_songs WHERE ply_id='$ply_id'";
  $result = mysqli_query($conn,$sql);
  $plyOutput = '';

  if($result->num_rows > 0){
      while ($row = mysqli_fetch_assoc($result)) {

        $song_num = $row['sng_id'];

        $sql = "SELECT * FROM songs WHERE sng_id='$song_num'";
        $songResult = mysqli_query($conn,$sql);

        $songRow = mysqli_fetch_assoc($songResult);

        $plyOutput .= '<div>
                        <a href="song.php?sng_id='. $song_num .'">'.$songRow['song_nm'].'</a>
                      </div>';
      }
  }else{
    $plyOutput .= 'Oops, there are no songs in this playlist.';
  }

  if(isset($_POST['addSongsPlaylist'])){
    header('Location: add-songs-playlist.php?ply_id='.$ply_id.'&ply_name='.$ply_name.'');
  }else if(isset($_POST['remSongsPlaylist'])){
    header('Location: rem-songs-playlist.php?ply_id='.$ply_id.'&ply_name='.$ply_name.'');
  }

?>

<!DOCTYPE html>
<html>
  <?php include('templates/header.php'); ?>
  <?php echo $plyOutput; ?>
  <div>
    <form method="POST">
      <button name="addSongsPlaylist">Add songs</button>
      <button name="remSongsPlaylist">Remove songs</button>
    </form>
  </div>
  <?php include('templates/footer.php'); ?>
</html>
