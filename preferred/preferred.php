<?php

  include '../config.php';
  error_reporting(0);

  session_start();

  $liked = '../liked/favs.php';
  $preferred = '../preferred/preferred.php';
  $playlists = '../playlists/my-playlists.php';
  $mySongs = '../uploads/my-uploads.php';

  $nav_pills = '';
  $nav_pills .= '<a class="nav-item nav-link" href="'.$liked.'">Liked</a>
              <a class="nav-item nav-link active" href="'.$preferred.'">Preferred</a>
              <a class="nav-item nav-link" href="'.$playlists.'">Playlists</a>
              <a class="nav-item nav-link" href="'.$mySongs.'">My uploads</a>';

  if (!isset($_SESSION['user'])) {
      header("Location: index.php");
  }

  $gen_output = '';
  $lang_output = '';
  $username = $_SESSION['user'];

  $sql = "SELECT * FROM users WHERE username='$username'";
  $result = mysqli_query($conn,$sql);

  if($result->num_rows > 0){
    $row = mysqli_fetch_assoc($result);
    $usr_id = $row['usr_id'];

    $sql = "SELECT * FROM user_gens WHERE usr_id='$usr_id'";
    $result = mysqli_query($conn,$sql);

      $gen_ids = [];

      if($result->num_rows > 0){
          while ($row = mysqli_fetch_assoc($result)) {
            array_push($gen_ids,$row['gen_id']);
          }
          $output = '<form action="" method="POST" class="">';
          foreach($gen_ids as $genre_num){
            $sql = "SELECT * FROM genre WHERE gen_id='$genre_num'";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($result);
            $gen_output .= '<div>
                          <a href="genre.php?gen_id='. $genre_num .'">'.$row['g_name'].'</a>
                        </div>';
          }
          $genre_present = TRUE;

      }else{
        $gen_output = '<div>No favourite Genres</div>';
        $_SESSION['genres'] = [];
      }

      $sql = "SELECT * FROM user_langs WHERE usr_id='$usr_id'";
      $result = mysqli_query($conn,$sql);

        $lang_ids = [];

        if($result->num_rows > 0){
            while ($row = mysqli_fetch_assoc($result)) {
              array_push($lang_ids,$row['lang_id']);
            }
            foreach($lang_ids as $lang_num){
              $sql = "SELECT * FROM language WHERE lang_id='$lang_num'";
              $result = mysqli_query($conn,$sql);
              $row = mysqli_fetch_assoc($result);
              $lang_output .= '<div>
                            <a href="language.php?lang_id='. $lang_num .'">'.$row['lang'].'</a>
                          </div>';
            }
        }else{
          $lang_output = '<div>No favourite Languages</div>';
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
  <?php print("$gen_output")?>
  <?php print("$lang_output")?>
  <?php include('../templates/footer.php'); ?>
</html>
