<?php

  include 'config.php';
  error_reporting(0);

  if(isset($_SESSION['seacrhButton'])){

      $str = $_SESSION['searchBar'];
      $sql = "SELECT * FROM songs WHERE song_nm='$str'";
      $result = mysqli_query($conn,$sql);

      if($result->num_rows > 0){
        $row = mysqli_fetch_assoc($result);
        echo $row['sng_id'] ." ". $row['song_nm'] ." ". $row['duration'];
      }else{
        echo "2 ".mysqli_error($conn);
      }

  }

?>
