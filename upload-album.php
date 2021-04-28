<?php

  include 'config.php';
  error_reporting(0);

  session_start();

  $usr_id = $_SESSION['user_id'];
  echo 'User id is '.$usr_id.'';
  $alb_name = '';

  if(isset($_POST['addSongs'])){

    $songNum = $_POST['songNum'];
    $alb_name = $_POST['albumName'];

    header('Location: add-songs-album.php?alb_name='.$alb_name.'&song_num='.$songNum.'');
    exit();

  }

?>


<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php'); ?>
    <div>
      <form action="" method="POST">
        <div class="input-group">
          <label>Album Name</label>
          <input type="text" placeholder="My Album" name="albumName" value="<?php echo $_POST['albumName'];  ?>" required>
        </div>
        <div class="input-group">
          <label>Number of songs that you want to add</label>
          <input type="number" min="1" placeholder="1" name="songNum" required>
        </div>
        <div class="input-group">
          <button name="addSongs" class="btn">Add songs</button>
        </div>
      </form>
    </div>
    <?php echo $uplOutput; ?>
    <?php include('templates/footer.php'); ?>
</html>
