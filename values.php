<?php

$httpProtocol = !isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != 'on' ? 'http' : 'https';
$root = $httpProtocol.'://'.$_SERVER['HTTP_HOST'].'/mms';

$server = "localhost";
$user = "root";
$pass = "";
$database = "mms";

/*$server = "sql307.epizy.com";
$user = "epiz_28481933";
$pass = "ujhjIz1koIRu4jN";
$database = "epiz_28481933_mms";*/

 ?>
