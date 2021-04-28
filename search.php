<?php

  include 'config.php';
  error_reporting(0);

  $output = '';

  if(isset($_POST['seacrhButton'])){
    $str = $_POST['searchBar'];
    $sql = "SELECT * FROM songs WHERE song_nm='$str'";
    $result = mysqli_query($conn,$sql);

    if($result->num_rows > 0){
      while ($row = mysqli_fetch_assoc($result)){
        $output .= '<div class="container bg-light">'. $row['song_nm'] ." ". $row['duration'] .'</div>';
      }
    }else{
      echo "str is ". $str ."Problem no row".mysqli_error($conn);
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php'); ?>
<?php echo $output; ?>
<?php include('templates/footer.php'); ?>
</html>
