<?php
error_reporting(0);
$host     = 'host'; //localhost
$user     = 'kullaniciAdi';
$pass     = 'databaseSifre';
$db        = 'databaseAdi';
$baglan = mysqli_connect($host, $user, $pass, $db) or die(mysqli_Error());
mysqli_query($baglan, "SET CHARACTER SET 'utf8'");
mysqli_query($baglan, "SET NAMES 'utf8'");
