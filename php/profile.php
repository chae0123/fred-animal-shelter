<!--
Web Programming II, CSIT-207
Project part II

Fred Animal Shelter Profile Page
Author: Jiwon Chae and Hannah Lombardi
Date: 5/16/2025

File Name: profile.php

This page will allow a user to update their profile

http://localhost/fred-animal-shelter/php/profile.php

-->

<?php

require_once 'auth.php';
require_once 'db.php';

$userId = $_SESSION['user_id'];
$success = '';
$errors = [];

// Fetch user data
$stmt = $conn->prepare("SELECT username, email, profile_image, bio FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newUsername = trim($_POST['username']);
    $newPassword = $_POST['password'];
    $newBio = trim($_POST['bio']);

    if (empty($newUsername)) {
        $errors[] = "Username cannot be empty.";
    } else {
        $imageFileName = $user['profile_image']; // Default to current image

        // Handle image upload
        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
            $uploadDir = "../images/profiles/";
            $imageFileName = basename($_FILES['profile_image']['name']);
            $targetFile = $uploadDir . $imageFileName;
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            // Check file type
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array($imageFileType, $allowedTypes)) {
                $errors[] = "Only JPG, JPEG, PNG, and GIF files are allowed.";
            } else {
                move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetFile);
            }
        }

        // Update query
        if (empty($errors)) {
            if (!empty($newPassword)) {
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("UPDATE users SET username = ?, password = ?, profile_image = ?, bio = ? WHERE id = ?");
                $stmt->bind_param("ssssi", $newUsername, $hashedPassword, $imageFileName, $newBio, $userId);
            } else {
                $stmt = $conn->prepare("UPDATE users SET username = ?, profile_image = ?, bio = ? WHERE id = ?");
    $stmt->bind_param("sssi", $newUsername, $imageFileName, $newBio, $userId);

            }

            if ($stmt->execute()) {
                $_SESSION['username'] = $newUsername;
                $success = "Profile updated successfully!";
                $user['username'] = $newUsername;
                $user['profile_image'] = $imageFileName;
            } else {
                $errors[] = "Failed to update profile.";
            }
            $stmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
</head>
<body>
<h2>My Profile</h2>

<?php
if (!empty($success)) echo "<p style='color: green;'>$success</p>";
foreach ($errors as $e) echo "<p style='color: red;'>$e</p>";
?>

<!-- Show current profile image -->
<?php
$profileImg = (!empty($user['profile_image']) && file_exists("../images/profiles/" . $user['profile_image']))
    ? "../images/profiles/" . htmlspecialchars($user['profile_image'])
    : "../images/profiles/default.png";
?>

<img src="<?php echo $profileImg; ?>" alt="Profile Picture" width="150" height="150" style="object-fit: cover; border-radius: 8px;">

<form method="POST" action="profile.php" enctype="multipart/form-data">
    <label>Username</label><br>
    <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required><br><br>

    <label>Email</label><br>
    <input type="email" value="<?php echo htmlspecialchars($user['email']); ?>" readonly><br><br>

    <label>New Password</label><br>
    <input type="password" name="password"><br><br>

    <label>Upload Profile Picture</label><br>
    <input type="file" name="profile_image" accept="image/*"><br><br>

    <label>About Me / Bio:</label><br>
    <textarea name="bio" rows="4" cols="40"><?php echo htmlspecialchars($user['bio'] ?? ''); ?></textarea><br><br>


    <button type="submit">Update Profile</button>
</form>

<p><a href="index.php">← Back to Home</a></p>

</body>
</html>
