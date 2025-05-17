<!--
Web Programming II, CSIT-207
Project part II

Fred Animal Shelter auth.php
Author: Jiwon Chae and Hannah Lombardi
Date: 5/16/2025

File Name: auth.php

// this php will be included on top of any protected page

-->

<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    // Not logged in, redirect to login page
    header("Location: login.php");
    exit();
}
?>
