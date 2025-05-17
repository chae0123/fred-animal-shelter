<!--
Web Programming II, CSIT-207
Project part 1

Fred Animal Shelter Volunteer Page
Author: Jiwon Chae and Hannah Lombardi
Date: 5/16/2025

File Name: volunteer.php

-->
<?php
require_once 'db.php';

$success = false;
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['vol_name'] ?? '');
    $age = (int)($_POST['vol_age'] ?? 0);
    $email = trim($_POST['vol_email'] ?? '');
    $availability = $_POST['availability'] ?? '';

    if (empty($name) || empty($email) || $age === 0 || empty($availability)) {
        $errors[] = "All fields are required.";
    } elseif ($age < 12) {
        $errors[] = "You must be at least 12 years old to volunteer.";
    } else {
        $stmt = $conn->prepare("INSERT INTO volunteers (name, age, email, availability) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siss", $name, $age, $email, $availability);

        if ($stmt->execute()) {
            $success = true;
        } else {
            $errors[] = "Database error. Please try again.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8" />
   <title>Volunteer</title>
   <link href="../css/base.css" rel="stylesheet" />
   <link href="../css/styles.css" rel="stylesheet" />
   <link href="../css/layout.css" rel="stylesheet" />
   <script>
      function volunteerForm() {
         let name = document.getElementById("vol_name").value;
         let age = document.getElementById("vol_age").value;
         let email = document.getElementById("vol_email").value;
         let availability = document.querySelector('input[name="availability"]:checked');

         if (name == "" || email == "" || age == "" || !availability) {
            alert("Please fill in all required fields.");
            return false;
         }

         if (age < 12) {
            alert("You must be at least 12 years old to volunteer.");
            return false;
         }

         return true;
      }
   </script>
</head>

<body>
   <img id="logo" src="../images/fred_animal_shelter_logo.png" alt="Fred Animal Shelter" />

   <nav class="horizontal">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="../about.html">About</a></li>
        <li><a href="donate.php">Donate</a></li>
        <li class="dropdown">
                <a href="adoptable.php">Adopt</a>
                <ul class="dropdown-menu">
                    <li><a href="adoptable.php">Adoptable Animals</a></li>
                    <li><a href="adopt.php">Application</a></li>
                </ul>
            </li>
        <li class="active"><a href="volunteer.php">Volunteer</a></li>
    </ul>
   </nav>

   <div class="form-container">
      <h1>Become a Volunteer</h1>
      <p>Fill out the form below to sign up as a volunteer.</p>

      <?php
      if ($success) {
         echo "<p class='success-msg'>Thank you for signing up to volunteer!</p>";
      } else {
         foreach ($errors as $e) {
            echo "<p class='error-msg'>$e</p>";
         }
      }
      ?>

      <form method="POST" action="volunteer.php" onsubmit="return volunteerForm()">
         <label for="vol_name">Full Name</label>
         <input type="text" id="vol_name" name="vol_name" required>

         <label for="vol_age">Age</label>
         <input type="number" id="vol_age" name="vol_age" required>

         <label for="vol_email">Email</label>
         <input type="email" id="vol_email" name="vol_email" required>

         <label>Availability</label>
         <label><input type="radio" id="weekdays" name="availability" value="Weekdays"> Weekdays</label>
         <label><input type="radio" id="weekends" name="availability" value="Weekends"> Weekends</label>
         <label><input type="radio" id="anytime" name="availability" value="Anytime"> Anytime</label>

         <button type="submit">Submit Volunteer Request</button>
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
