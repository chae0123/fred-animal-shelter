<?php
require_once 'auth.php';  // Only logged-in users can access
require_once 'db.php';    // Connect to DB

$errors = [];
$success = false;

// Fetch all available pets for dropdown
$pets = [];
$result = $conn->query("SELECT id, name FROM pets WHERE status = 'available'");
while ($row = $result->fetch_assoc()) {
    $pets[] = $row;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pet_id = $_POST['pet_id'] ?? '';
    $message = trim($_POST['message']);

    if (empty($pet_id) || empty($message)) {
        $errors[] = "Please select a pet and write a message.";
    } else {
        $user_id = $_SESSION['user_id'];

        $stmt = $conn->prepare("INSERT INTO adoption_requests (user_id, pet_id, message) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $user_id, $pet_id, $message);

        if ($stmt->execute()) {
            $success = true;
        } else {
            $errors[] = "Failed to submit request. Try again.";
        }

        $stmt->close();
    }
}
?>

<!-- Adoption Request Form -->
<!DOCTYPE html>
<html>
<head>
    <title>Adoption Request</title>
</head>
<body>

<h2>Submit Adoption Request</h2>

<?php
if ($success) {
    echo "<p style='color: green;'>Your adoption request has been submitted!</p>";
} else {
    foreach ($errors as $error) {
        echo "<p style='color: red;'>$error</p>";
    }
}
?>

<form method="POST" action="submit_adoption_request.php">
    <label for="pet_id">Choose a Pet:</label><br>
    <select name="pet_id" required>
        <option value="">-- Select Pet --</option>
        <?php foreach ($pets as $pet): ?>
            <option value="<?php echo $pet['id']; ?>"><?php echo htmlspecialchars($pet['name']); ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="message">Why would you like to adopt this pet?</label><br>
    <textarea name="message" rows="4" cols="40" required></textarea><br><br>

    <button type="submit">Submit Request</button>
</form>

<p><a href="dashboard.php">← Back to Dashboard</a></p>

</body>
</html>
