<?php

  include 'values.php';
  $conn = mysqli_connect($server, $user, $pass, $database);

  if(!$conn){
    die("<script>alert('Connection Failed.')</script>");
  }

 ?>
