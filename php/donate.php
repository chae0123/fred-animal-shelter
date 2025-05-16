<!--
Web Programming II, CSIT-207
Project part II

Fred Animal Shelter Donate Page
Author: Jiwon Chae and Hannah Lombardi
Date: 3/2/2025

File Name: donate.html
http://localhost/fred-animal-shelter/php/donate.php
-->
<?php

require_once 'db.php';

$success = false;
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['donor_name'] ?? '');
    $email = trim($_POST['donor_email'] ?? '');
    $amount = ($_POST['amount'] === 'custom') ? $_POST['custom_amount'] : $_POST['amount'];
    $card_number = trim($_POST['card_number'] ?? '');

    if (empty($name) || empty($email) || empty($amount) || empty($card_number)) {
        $errors[] = "All fields are required.";
    } elseif (!is_numeric($amount) || $amount <= 0) {
        $errors[] = "Donation amount must be valid.";
    } else {
        $last4 = substr($card_number, -4);

        $stmt = $conn->prepare("INSERT INTO donations (name, email, amount, card_last4) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssds", $name, $email, $amount, $last4);

        if ($stmt->execute()) {
            $success = true;
        } else {
            $errors[] = "Database error.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8" />
   <title>Donate</title>
   <link href="../css/base.css" rel="stylesheet" />
   <link href="../css/styles.css" rel="stylesheet" />
   <link href="../css/layout.css" rel="stylesheet" />
   <script>
      function toggleCustomAmount() {
         const amount = document.getElementById("amount").value;
         document.getElementById("customAmountContainer").style.display =
            (amount === "custom") ? "block" : "none";
      }

      function validateDonationForm() {
         const amount = document.getElementById("amount").value;
         const custom = document.getElementById("custom_amount").value;
         if (amount === "custom" && (custom === "" || parseFloat(custom) <= 0)) {
            alert("Please enter a valid custom amount.");
            return false;
         }
         return true;
      }
   </script>
</head>

<body>
   <!-- Logo -->
   <img id="logo" src="../images/fred_animal_shelter_logo.png" alt="Fred Animal Shelter" />

   <!-- Navigation -->
   <nav class="horizontal">
      <ul>
         <li><a href="index.php">Home</a></li>
         <li><a href="../about.html">About</a></li>
         <li class="active"><a href="donate.php">Donate</a></li>
         <li><a href="adopt.php">Adopt</a></li>
         <li><a href="volunteer.php">Volunteer</a></li>
      </ul>
   </nav>

   <!-- Donation Form -->
   <div class="form-container">
      <h1>Support Fred Animal Shelter</h1>
      <p>Your generous donation helps us provide food, shelter, and medical care to animals in need.</p>

      <?php
      if ($success) {
         echo "<p class='success-msg'>Thank you for your donation!</p>";
      } else {
         foreach ($errors as $e) {
            echo "<p class='error-msg'>$e</p>";
         }
      }
      ?>

      <form method="POST" action="donate.php" onsubmit="return validateDonationForm()">
         <label for="donor_name">Full Name</label>
         <input type="text" id="donor_name" name="donor_name" required>

         <label for="donor_email">Email</label>
         <input type="email" id="donor_email" name="donor_email" required>

         <label for="amount">Donation Amount</label>
         <select id="amount" name="amount" onchange="toggleCustomAmount()" required>
            <option value="">Select an amount</option>
            <option value="10">$10</option>
            <option value="25">$25</option>
            <option value="50">$50</option>
            <option value="100">$100</option>
            <option value="custom">Custom Amount</option>
         </select>

         <div id="customAmountContainer" style="display:none;">
            <label for="custom_amount">Enter Custom Amount ($)</label>
            <input type="number" id="custom_amount" name="custom_amount" min="1">
         </div>

         <label for="card_number">Credit Card Number</label>
         <input type="text" id="card_number" name="card_number" maxlength="16" pattern="\d{16}" placeholder="1234123412341234" required>

         <button type="submit">Donate Now</button>
      </form>
   </div>

   <footer>
      Fred Animal Shelter; &copy; 2025 All Rights Reserved
   </footer>
</body>
</html>