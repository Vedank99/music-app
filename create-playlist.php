<?php

  include 'config.php';
  error_reporting(0);

  session_start();

  if(isset($_POST['createPlaylist'])){

    $playlist_name = $_POST['playlistName'];

    $userName = $_SESSION['user'];

    $sql = "SELECT * FROM users WHERE username='$userName'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $user_id = $row['usr_id'];

    $sql = "INSERT INTO user_playlist (ply_name,usr_id)
            VALUES ('$playlist_name','$user_id')";
    $result = mysqli_query($conn, $sql);

    if($result){

      $ply_id = $conn->insert_id;
      header('Location: playlist.php?ply_id='.$ply_id.'&ply_name='.$playlist_name.'');
      exit();

    }else{
      $uplOutput .= "<div>Oops there was a problem in uploading.</div>";
    }
  }

?>


<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php'); ?>
    <div>
      <form action="" method="POST">
        <div class="input-group">
          <label>Playlist Name</label>
          <input type="text" placeholder="My Playlist" name="playlistName" required>
        </div>
        <div class="input-group">
          <button name="createPlaylist" class="btn">Create Playlist</button>
        </div>
      </form>
    </div>
    <?php echo $uplOutput; ?>
    <?php include('templates/footer.php'); ?>
    <script>

    </script>
</html>
