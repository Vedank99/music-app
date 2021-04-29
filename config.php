<?php

  include 'values.php';

  //The variables in values.php file are
  //$server
  //$user
  //$pass
  //$database
  //$root (The root server of the app)

  $conn = mysqli_connect($server, $user, $pass, $database);

  if(!$conn){
    die("<script>alert('Connection Failed.')</script>");
  }

 ?>
