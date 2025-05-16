<?php
// register.php

require_once 'db.php'; // connect to the database

$errors = [];
$success = false;

// handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // sanitize inputs
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // validation
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $errors[] = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    } elseif ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    if (empty($errors)) {
        // hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // insert user into database using prepared statement
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashedPassword);

        if ($stmt->execute()) {
            $success = true;
        } else {
            $errors[] = "Username or email already exists.";
        }

        $stmt->close();
    }
}
?>

<!-- registration Form (HTML) -->
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
<h2>User Registration</h2>

<?php
if ($success) {
    echo "<p style='color: green;'>Registration successful! <a href='login.php'>Login here</a>.</p>";
} else {
    foreach ($errors as $error) {
        echo "<p style='color: red;'>$error</p>";
    }
}
?>

<form method="POST" action="register.php">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <label>Confirm Password:</label><br>
    <input type="password" name="confirm_password" required><br><br>

    <button type="submit">Register</button>
</form>

</body>
</html>
