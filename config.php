<?php

  /*$server = "sql307.epizy.com";
  $user = "epiz_28481933";
  $pass = "ujhjIz1koIRu4jN";
  $database = "epiz_28481933_mms";*/

  $root = basename(__DIR__);

  $server = "localhost";
  $user = "root";
  $pass = "";
  $database = "mms";

  $conn = mysqli_connect($server, $user, $pass, $database);

  if(!$conn){
    die("<script>alert('Connection Failed.')</script>");
  }

 ?>
