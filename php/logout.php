<!--
Web Programming II, CSIT-207
Project part II

Fred Animal Shelter Logout
Author: Jiwon Chae and Hannah Lombardi
Date: 5/16/2025

File Name: logout.php

ends the session and redirects to the main index homepage
http://localhost/fred-animal-shelter/php/index.php

-->

<?php

session_start();         // Start the session
session_unset();         // Unset all session variables
session_destroy();       // Destroy the session

// redirect to login page
header("Location: index.php");
exit();
