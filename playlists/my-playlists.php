<?php

  include '../config.php';
  error_reporting(0);

  session_start();

  $liked = '../liked/favs.php';
  $preferred = '../preferred/fav-genre.php';
  $playlists = '../playlists/my-playlists.php';
  $mySongs = '../uploads/my-songs.php';

  $nav_pills = '';
  $nav_pills .= '<a class="nav-item nav-link" href="'.$liked.'">Liked</a>
              <a class="nav-item nav-link" href="'.$preferred.'">Preferred</a>
              <a class="nav-item nav-link active" href="'.$playlists.'">Playlists</a>
              <a class="nav-item nav-link" href="'.$mySongs.'">My uploads</a>';

  if (!isset($_SESSION['user'])) {
      header("Location: index.php");
  }

  $ply_output = '';
  $username = $_SESSION['user'];

  $sql = "SELECT * FROM users WHERE username='$username'";
  $result = mysqli_query($conn,$sql);

  if($result->num_rows > 0){
    $row = mysqli_fetch_assoc($result);
    $usr_id = $row['usr_id'];

    $sql = "SELECT * FROM user_playlist WHERE usr_id='$usr_id'";
    $result = mysqli_query($conn,$sql);

      if($result->num_rows > 0){
          while ($row = mysqli_fetch_assoc($result)) {
            $ply_output .= '<div>
                          <a href="playlist.php?ply_id='.$row['ply_id'].'&ply_name="'.$row['ply_name'].'>'.$row['ply_name'].'</a>
                        </div>';
          }

      }else{
        $ply_output = '<div>No playlists created</div>';
        $_SESSION['genres'] = [];
      }
  }else{
    echo "Some error occured. Please go back.";
  }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <?php include('../templates/header-profile.php'); ?>
  <nav class="nav nav-pills nav-justified">
    <?php print("$nav_pills")?>
  </nav>
  <?php print("$ply_output")?>
  <div><a href="create-playlist.php">Create playlist</a></div>
  <?php include('../templates/footer.php'); ?>
</html>
