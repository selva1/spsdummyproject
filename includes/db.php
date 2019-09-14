<?php 
function dbconnection(){

$servername = "localhost";
$username = "root";
$password = "selvapalani123";
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
