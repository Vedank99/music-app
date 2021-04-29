<?php

  include 'config.php';
  error_reporting(0);

  session_start();

  $usr_id = $_SESSION['user_id'];
  $alb_name = $_GET['alb_name'];
  $songNum = $_GET['song_num'];

  $uplOutput = '';
  $uplOutput .= '<form method="POST">';
  for($i=0;$i<$songNum;$i++){

    $uplOutput .= '<div>
                    <label>Song name</label>
                    <input type="text" name="addSong[]" placeholder="My song"/>
                    <label>Song Duration</label>
                    <input type="time" name="songTime[]"/>
                   </div>';

  }
  $uplOutput .= '<div class="input-group">
                  <button name="cancelUpload" class="btn">Cancel</button>
                 </div>';

  $uplOutput .= '<div class="input-group">
                  <button name="uploadAlbum" class="btn">Upload album</button>
                 </div>';
  $uplOutput .= '</form>';

  if(isset($_POST['cancelUpload'])){
    header('Location: upload-album.php');
    exit();
  }

  $noError = TRUE;

  if(isset($_POST['uploadAlbum'])){

    $songs = $_POST['addSong'];
    $duration = $_POST['songTime'];

    for($i=0;$i<$songNum;$i++){
      echo 'Song name at '.$i.' is '.$songs[$i].'';
      if(strlen($songs[$i]) == 0){
        $noError = FALSE;
        //break;
      }

    }

    if($noError === TRUE){

      //$alb_name = $_POST['albumName'];
      $sql = "INSERT INTO albums (usr_id,alb_name) VALUES ('$usr_id','$alb_name')";
      $result = mysqli_query($conn,$sql);

      if($result){

        $alb_id = $conn->insert_id;

        for($i=0;$i<$songNum;$i++){

          $sql = "INSERT INTO songs (song_nm,duration,usr_id) VALUES ('$songs[$i]','$duration[$i]','$usr_id')";
          $result = mysqli_query($conn,$sql);

          if($result){

            $sng_id = $conn->insert_id;
            $sql = "INSERT INTO alb_songs (alb_id,sng_id) VALUES ('$alb_id','$sng_id')";
            $result = mysqli_query($conn,$sql);

            if(!$result){
              echo 'Song insertion error at '.$i.' : '.mysqli_error($conn).'';
              break;
            }

          }else{
            echo 'Song uploading error at '.$i.' : '.mysqli_error($conn).'';
            break;
          }

        }

      }else{
        echo 'Album creation error : '.mysqli_error($conn).'';
      }

      if($result){
        header('Location: uploads/my-uploads.php');
        exit();
      }

    }else{
      $uplOutput .= '<div>The album name and the song names must not be empty. Check again and try.</div>';
      $noError = TRUE;
    }

  }

?>


<!DOCTYPE html>
<html lang="en">
  <?php include('templates/header.php'); ?>
  <?php echo $uplOutput; ?>
  <?php include('templates/footer.php'); ?>
</html>
