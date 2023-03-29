<?php
error_reporting(0);
$host     = '127.0.0.1'; //localhost
$user     = 'root';
$pass     = 'Biskuvi123';
$db        = 'midyepanel_v2';
$baglan = mysqli_connect($host, $user, $pass, $db) or die(mysqli_Error());
mysqli_query($baglan, "SET CHARACTER SET 'utf8'");
mysqli_query($baglan, "SET NAMES 'utf8'");
