<?php
require_once 'auth.php'; // protect the page
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
</head>
<body>

<h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>

<p>You are successfully logged in.</p>

<p><a href="logout.php">Logout</a></p>

</body>
</html>
