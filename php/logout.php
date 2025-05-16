<?php
// logout.php
// ends the session and redirects to login page
// http://localhost/fred-animal-shelter/php/index.php

session_start();         // Start the session
session_unset();         // Unset all session variables
session_destroy();       // Destroy the session

// redirect to login page
header("Location: index.php");
exit();
