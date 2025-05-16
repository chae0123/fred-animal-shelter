<?php

// db.php — connects to the MySQL database using mysqli using XAMPP

$servername = "localhost";
$username = "root";
$password = ""; // default has no password
$dbname = "fred_shelter"; //  DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>