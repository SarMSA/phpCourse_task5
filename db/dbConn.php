<?php
session_start();
$server = 'localhost';
$dbUser = 'root';
$dbPassword  = '';
$dbName = 'hospital';

$conn = mysqli_connect($server, $dbUser, $dbPassword, $dbName);
if(!($conn)) 
{
    die("error: ".mysqli_connect_error());
}
?>
