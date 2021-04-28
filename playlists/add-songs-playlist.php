<?php

  include '../config.php';
  error_reporting(0);

  session_start();

  $output = '';
  $ply_id = $_GET['ply_id'];
  $ply_name = $_GET['ply_name'];

  if(isset($_POST['songBtn'])){
    $str = $_POST['searchSong'];

    $sql = "SELECT * FROM songs WHERE song_nm='$str' AND sng_id NOT IN (SELECT sng_id FROM ply_songs WHERE ply_id='$ply_id')";
    $result = mysqli_query($conn,$sql);

    if($result->num_rows > 0){


      $output .= '<div>Check the songs which you want to add</div>';
      $output .= '<form method="POST">';
      while ($row = mysqli_fetch_assoc($result)){

        $output .= '<div class="container bg-light">
                      <input type="checkbox" name="songResults[]" value="'.$row['sng_id'].'" />
                      <span>'.$row['song_nm'].'</span>
                    </div>';
      }

      $output .= '<button name="songResBtn">Add</button>';
      $output .= '</form>';

    }else{
      $output .= '<div>There are no songs with this name</div>';
    }
    unset($_POST['songBtn']);
  }

  if(isset($_POST['songResBtn'])){

    $songResults = $_POST['songResults'];
    if(empty($songResults)){
      $output .="<div>You didn't select any songs.</div>";
    }else{
      $N = count($songResults);
      for($i=0; $i < $N; $i++){
        $sql = "INSERT INTO ply_songs (ply_id,sng_id)
                VALUES ('$ply_id','$songResults[$i]')";
        $result = mysqli_query($conn,$sql);
        if(!$result){
          break;
        }
      }
      if(!$result){
        $output .= '<div>Some error occured</div>';
      }else{
        $output .= '<div>Songs added successfully</div>';
      }
    }
    unset($_POST['songResBtn']);
  }

  if(isset($_POST['doneBtn'])){
    header('Location: playlist.php?ply_id='.$ply_id.'&ply_name='.$ply_name.'');
    exit();
  }

?>


<!DOCTYPE html>
<html lang="en">
<?php include('../templates/header.php'); ?>
    <div>
      <form method="POST">
        <input class="form-control me-2" name="searchSong" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" name="songBtn" type="submit">Search</button>
      </form>
    </div>
    <?php echo $output; ?>
    <form method="POST">
      <div class="input-group">
        <button name="doneBtn" class="btn">Done</button>
      </div>
    </form>
    <?php include('../templates/footer.php'); ?>
</html>
