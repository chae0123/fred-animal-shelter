<?php
// db.php — connects to the MySQL database using mysqli

$host = 'localhost';       
$db   = 'animal_shelter';
$user = 'root';
$pass = '';                // default password is empty

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

?>
