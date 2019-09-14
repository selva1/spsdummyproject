<?php
session_start();

function dbconnection(){

$servername = "localhost";
$username = "phpmyadminuser";
$password = "Selva@123";
$dbname = "sudumandapam";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

return $conn;

}

function url(){
  return sprintf(
    "%s://%s%s",
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
    $_SERVER['SERVER_NAME'],
    $_SERVER['REQUEST_URI']
  );
}

$siteAdminUrl="http://ec2-13-234-239-82.ap-south-1.compute.amazonaws.com/sudu-mandapam/";
$siteUrl="http://ec2-13-234-239-82.ap-south-1.compute.amazonaws.com/";
define("SITE_URL","http://ec2-13-234-239-82.ap-south-1.compute.amazonaws.com/");
?>