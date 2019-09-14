<?php 
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

?>
