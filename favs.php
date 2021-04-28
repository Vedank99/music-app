<?php

  $parent = dirname( dirname(__FILE__) );
  include 'config.php';
  echo '\\'.$root;
  error_reporting(0);

  session_start();

  if (!isset($_SESSION['user'])) {
      header("Location: index.php");
  }

  $songOutput = '';
  $albumOutput = '';
  $username = $_SESSION['user'];

  $sql = "SELECT * FROM users WHERE username='$username'";
  $result = mysqli_query($conn,$sql);

  if($result->num_rows > 0){

    $row = mysqli_fetch_assoc($result);
    $usr_id = $row['usr_id'];
    $sql = "SELECT * FROM user_songs WHERE usr_id='$usr_id'";
    $result = mysqli_query($conn,$sql);

      $sng_ids = [];

      if($result->num_rows > 0){
          while ($row = mysqli_fetch_assoc($result)) {
            array_push($sng_ids,$row['sng_id']);
          }
          foreach($sng_ids as $song_num){
            $sql = "SELECT * FROM songs WHERE sng_id='$song_num'";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($result);
            $songOutput .= '<div>
                          <a href="song.php?sng_id='. $song_num .'">'.$row['song_nm'].'</a>
                        </div>';
          }

      }else{
        $songOutput = '<div>No favourite songs</div>';
      }

      $sql = "SELECT * FROM user_albums WHERE usr_id='$usr_id'";
      $result = mysqli_query($conn,$sql);

        $alb_ids = [];

        if($result->num_rows > 0){
            while ($row = mysqli_fetch_assoc($result)) {
              array_push($alb_ids,$row['alb_id']);
            }
            foreach($alb_ids as $album_num){
              $sql = "SELECT * FROM albums WHERE alb_id='$album_num'";
              $result = mysqli_query($conn,$sql);
              $row = mysqli_fetch_assoc($result);
              $albumOutput .= '<div>
                                <a href="album.php?alb_id='.$album_num.'">'.$row['alb_name'].'</a>
                              </div>';
            }

        }else{
          $albumOutput = '<div>No favourite albums</div>';
        }

  }else{
    echo "Some error occured. Please go back.";
  }

  if(isset($_POST['addSongs'])){
    header('Location: add-song-fav.php');
  }else if(isset($_POST['removeSongs'])){
    header('Location: rem-song-fav.php');
  }

  if(isset($_POST['addAlbums'])){
    header('Location: add-album-fav.php');
  }else if(isset($_POST['removeAlbums'])){
    header('Location: rem-album-fav.php');
  }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <?php include 'templates\header-profile.php'; ?>
  <div>Favourite songs</div>
  <?php print("$songOutput")?>
  <form method="POST">
    <button name="addSongs">Add songs</button>
    <button name="removeSongs">Remove songs</button>
  </form>
  <div>Favourite albums</div>
  <?php print("$albumOutput")?>
  <form method="POST">
    <button name="addAlbums">Add albums</button>
    <button name="removeAlbums">Remove albums</button>
  </form>
  <?php include('templates/footer.php'); ?>
</html>
