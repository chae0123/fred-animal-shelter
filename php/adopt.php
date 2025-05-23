<!--
Web Programming II, CSIT-207
Project part II

Fred Animal Shelter Adopt application Page
Author: Jiwon Chae and Hannah Lombardi
Date: 5/16/2025

File Name: adopt.php

This php is for adopt application.
** User login is required for this page.

http://localhost/fred-animal-shelter/php/adopt.php

-->

<?php
require_once 'auth.php';  // ensure the user is logged in
require_once 'db.php';    // DB connection

$errors = [];
$success = false;

// Fetch pets from database
$pets = [];
$result = $conn->query("SELECT id, name FROM pets WHERE status = 'available'");
while ($row = $result->fetch_assoc()) {
    $pets[] = $row;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $pet_id = $_POST['pet_id'] ?? '';
    $message = trim($_POST['message'] ?? '');

    if (empty($pet_id) || empty($message)) {
        $errors[] = "Please select a pet and enter your reason.";
    } else {
        $stmt = $conn->prepare("INSERT INTO adoption_requests (user_id, pet_id, message) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $user_id, $pet_id, $message);
        if ($stmt->execute()) {
            $success = true;
        } else {
            $errors[] = "Error submitting request.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8" />
   <title>Adopt</title>
   <link href="../css/base.css" rel="stylesheet" />
   <link href="../css/styles.css" rel="stylesheet" />
   <link href="../css/layout.css" rel="stylesheet" />
</head>

<body>
   <img id="logo" src="../images/fred_animal_shelter_logo.png" alt="Fred Animal Shelter" />

   <nav class="horizontal">
      <ul>
         <li><a href="index.php">Home</a></li>
         <li><a href="../about.html">About</a></li>
         <li><a href="donate.php">Donate</a></li>

         <li class="dropdown active">
            <a href="adoptable.php">Adopt</a>
            <ul class="dropdown-menu">
                <li><a href="adoptable.php">Adoptable Animals</a></li>
                <li><a href="adopt.php">Application</a></li>
            </ul>
        </li>

         <li><a href="volunteer.php">Volunteer</a></li>
      </ul>
   </nav>

   <!-- Adoption form container -->
   <div class="form-container">
    <h1>Adopt a Pet</h1>
    <p>Fill out the form below to start the adoption process.</p>

    <?php
    if ($success) {
       echo "<p class='success-msg'>Adoption request submitted successfully!</p>";
    } else {
       foreach ($errors as $error) {
           echo "<p class='error-msg'>$error</p>";
       }
    }
   ?>

    <form method="POST" action="adopt.php">
      <label for="pet_id">Select a Pet</label>
      <select id="pet_id" name="pet_id" required>
         <option value="">-- Choose a Pet --</option>
         <?php foreach ($pets as $pet): ?>
            <option value="<?php echo $pet['id']; ?>">
               <?php echo htmlspecialchars($pet['name']); ?>
            </option>
         <?php endforeach; ?>
      </select>

      <label for="message">Why would you like to adopt this pet?</label>
      <textarea id="message" name="message" rows="4" required></textarea>

      <button type="submit">Submit Adoption Request</button>
    </form>
    </div>

   <footer>
        <p>Fred Animal Shelter; &copy; 2025 All Rights Reserved</p>
        <p>Email: <a href="mailto:info@fredshelter.org">info@fredshelter.org</a></p>
        <p>Phone: <a href="tel:1234567890">(123) 456-7890</a></p>
        <p>Address: 1234 Furry Street, Fredonia, NY 14063</p>
    </footer>
</body>
</html>
