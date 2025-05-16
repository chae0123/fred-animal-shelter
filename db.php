<?php
// db.php — connects to the MySQL database using mysqli

$host = 'localhost';       // If you're using XAMPP or WAMP, localhost is fine
$db   = 'animal_shelter';  // Name of your database from database.sql
$user = 'root';            // Default username for local XAMPP
$pass = '';                // Default password is empty on XAMPP

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Optional: Uncomment for debugging
// echo "Connected successfully";
?>
