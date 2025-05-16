<?php
// auth.php
// this php will be included on top of any protected page

session_start();

if (!isset($_SESSION['user_id'])) {
    // Not logged in, redirect to login page
    header("Location: login.php");
    exit();
}
?>
