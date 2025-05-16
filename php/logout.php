<?php
// logout.php
// ends the session and redirects to login page

session_start();         // Start the session
session_unset();         // Unset all session variables
session_destroy();       // Destroy the session

// redirect to login page
header("Location: login.php");
exit();
