<!--
Web Programming II, CSIT-207
Project part II

Fred Animal Shelter Database connection
Author: Jiwon Chae and Hannah Lombardi
Date: 5/16/2025

File Name: db.php

// this php will connect to the MySQL database using mysqli XAMPP

-->

<?php

$servername = "localhost";
$username = "root";
$password = ""; // default has no password
$dbname = "animal_shelter"; //  DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>