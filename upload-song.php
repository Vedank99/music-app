<?php

  include 'config.php';
  error_reporting(0);

  session_start();

  if(isset($_POST['uploadSong'])){

    $song_name = $_POST['songName'];
		$duration = $_POST['songDuration'];
    $uplOutput = '';
    $userName = $_SESSION['user'];

    $sql = "SELECT * FROM users WHERE username='$userName'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $user_id = $row['usr_id'];

    $sql = "INSERT INTO songs (song_nm,duration,usr_id)
            VALUES ('$song_name','$duration','$user_id')";
    $result = mysqli_query($conn, $sql);

    if($result){
      $uplOutput .= "<div>Song Successfully uploaded.</div>
                     <div><form method='POST'><button name='okUpload'>OK</button></form></div>";
      if(isset($_POST['okUpload'])){
        header('Location: upload.php');
        exit();
      }
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
          <label>Song Name</label>
          <input type="text" placeholder="My Song" name="songName" required>
        </div>
        <div class="input-group">
          <label>Song Duration</label>
          <input type="time" name="songDuration" required>
        </div>
        <div class="input-group">
          <button name="uploadSong" class="btn">Upload</button>
        </div>
      </form>
    </div>
    <?php echo $uplOutput; ?>
    <?php include('templates/footer.php'); ?>
</html>
