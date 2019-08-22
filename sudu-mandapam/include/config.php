<?php
session_start();

function dbconnection(){

$servername = "localhost";
$username = "root";
$password = "selvakavi123";
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

$siteAdminUrl="http://www.spsbrands.com/sudu-mandapam/";
$siteUrl="http://www.spsbrands.com/";
define("SITE_URL","http://www.spsbrands.com/");
?>