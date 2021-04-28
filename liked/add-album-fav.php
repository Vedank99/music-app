<?php

  include '../config.php';
  error_reporting(0);

  session_start();

  $output = '';
  $username = $_SESSION['user'];
  $usr_id = $_SESSION['user_id'];

  if(isset($_POST['albumBtn'])){
    $str = $_POST['searchAlbum'];

    $sql = "SELECT * FROM albums WHERE alb_name='$str' AND alb_id NOT IN (SELECT alb_id FROM user_albums WHERE usr_id='$usr_id')";
    $result = mysqli_query($conn,$sql);

    if($result->num_rows > 0){


      $output .= '<div>Check the albums which you want to add to favourites</div>';
      $output .= '<form method="POST">';
      while ($row = mysqli_fetch_assoc($result)){

        $output .= '<div class="container bg-light">
                      <input type="checkbox" name="albumResults[]" value="'.$row['alb_id'].'" />
                      <span>'.$row['alb_name'].'</span>
                    </div>';
      }

      $output .= '<button name="albumResBtn">Add</button>';
      $output .= '</form>';

    }else{
      $output .= '<div>There are no albums with this name</div>';
    }
    unset($_POST['albumBtn']);
  }

  if(isset($_POST['albumResBtn'])){

    $albumResults = $_POST['albumResults'];
    if(empty($albumResults)){
      $output .="<div>You didn't select any albums.</div>";
    }else{
      $N = count($albumResults);
      for($i=0; $i < $N; $i++){
        $sql = "INSERT INTO user_albums (usr_id,alb_id)
                VALUES ('$usr_id','$albumResults[$i]')";
        $result = mysqli_query($conn,$sql);
        if(!$result){
          break;
        }
      }
      if(!$result){
        $output .= '<div>Some error occured '.mysqli_error($conn).'</div>';
      }else{
        $output .= '<div>Albums added successfully</div>';
      }
    }
    unset($_POST['albumResBtn']);
  }

  if(isset($_POST['doneBtn'])){
    header('Location: favs.php');
    exit();
  }

?>


<!DOCTYPE html>
<html lang="en">
<?php include('../templates/header.php'); ?>
    <div>
      <form method="POST">
        <input class="form-control me-2" name="searchAlbum" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" name="albumBtn" type="submit">Search</button>
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
