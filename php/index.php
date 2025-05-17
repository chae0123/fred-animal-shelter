<!--
Web Programming II, CSIT-207
Project part II

Fred Animal Shelter Homepage
Author: Jiwon Chae and Hannah Lombardi
Date: 3/2/2025

File Name: index.php
http://localhost/fred-animal-shelter/php/index.php

-->

<?php
session_start();
require_once 'db.php';

$loggedIn = isset($_SESSION['user_id']);
if ($loggedIn) {
    $userId = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT username, profile_image, bio FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    $profileImg = (!empty($user['profile_image']) && file_exists("../images/profiles/" . $user['profile_image']))
        ? "../images/profiles/" . htmlspecialchars($user['profile_image'])
        : "../images/profiles/default.png";

    $bio = !empty($user['bio']) ? htmlspecialchars($user['bio']) : "No bio provided yet.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8" />
   <title>Fred Animal Shelter</title>
   <link href="../css/base.css" rel="stylesheet" />
   <link href="../css/styles.css" rel="stylesheet" />
   <link href="../css/layout.css" rel="stylesheet" />
   
</head>

<body>
   <!-- Logo -->
   <img id="logo" src="../images/fred_animal_shelter_logo.png" alt="Fred Animal Shelter" />

   <!-- Navigation -->
   <nav class="horizontal">
      <ul>
         <li class="active"><a href="index.php">Home</a></li>
         <li><a href="../about.html">About</a></li>
         <li><a href="donate.php">Donate</a></li>
         <li class="dropdown">
                <a href="adoptable.php">Adopt</a>
                <ul class="dropdown-menu">
                    <li><a href="adoptable.php">Adoptable Animals</a></li>
                    <li><a href="adopt.php">Application</a></li>
                </ul>
            </li>
         <li><a href="volunteer.php">Volunteer</a></li>
      </ul>
   </nav>
   

   <!-- Session Links -->
   <?php if ($loggedIn): ?>
   <div class="profile-section-wrapper">
      <div class="user-session right-align-session">
         
         <p class="welcome-line">Welcome back, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></p>
         <p class="session-links">
            <a href="profile.php">Profile</a> |
            <a href="logout.php">Logout</a>
         </p>
      </div>

      <div class="user-profile top-profile">
         <img class="profile-pic" src="<?php echo $profileImg; ?>" alt="Profile Picture">
         <h2>Hello, <?php echo htmlspecialchars($user['username']); ?>!</h2>
         <p class="bio"><?php echo nl2br($bio); ?></p>
      </div>
   </div>
   <?php else: ?>
   <div class="user-session right-align-session">
      <p class="session-links">
         <a href="login.php">Login</a> |
         <a href="register.php">Register</a>
      </p>
   </div>
   <?php endif; ?>

   <!-- Animal Boxes - 4 in one row -->
   <div class="intro-row">
      <div class="intro-card">
         <img src="../images/cat_silhouette1.png" alt="cat_1" class="animal-silhouette" />
         <p>We specialize in keeping all of our furry friends happy and healthy so they can come home with you ready to go!</p>
      </div>
      <div class="intro-card">
         <img src="../images/dog_silhouette1.png" alt="dog_1" class="animal-silhouette" />
         <p>If you see an animal on the streets, don't hesitate to contact us! We take in all kinds of animals in need.</p>
      </div>
      <div class="intro-card">
         <img src="../images/cat_silhouette2.png" alt="cat_2" class="animal-silhouette" />
         <p>Stop by! We're sure we have a pet for everyone here. Big, small, active, laid-back, you name it, we have it! Come find your forever friend today.</p>
      </div>
      <div class="intro-card">
         <img src="../images/dog_silhouette2.png" alt="dog_2" class="animal-silhouette" />
         <p>Donating is never an obligation, but it does help us fund the care these animals need! Please consider helping us out and more importantly, the animals!</p>
      </div>
   </div>

   <!-- Testimonials - 2 per row -->
   <div class="testimonials-container">
      <!-- First row of testimonials -->
      <div class="testimonial-row">
         <div class="testimonial-box">
            <img src="../images/sp_student1.png" alt="stud_1" />
            <div class="testimonial-content">
               <p>&ldquo;Thanks to the <em>Fred Animal Shelter</em> I found my best friend.&rdquo;</p>
               <p>&mdash; Kevin, 12th Grade, Fredonia NY</p>
            </div>
         </div>
         <div class="testimonial-box">
            <img src="../images/sp_student2.png" alt="stud_2" />
            <div class="testimonial-content">
               <p>&ldquo;I love volunteering at the <em>Fred Animal Shelter</em>, the staff is phenomenal and the pets are sweethearts.&rdquo;</p>
               <p>&mdash; Paul, 12th Grade, Dunkirk NY</p>
            </div>
         </div>
      </div>
      
      <!-- Second row of testimonials -->
      <div class="testimonial-row">
         <div class="testimonial-box">
            <img src="../images/sp_student3.png" alt="stud_3" />
            <div class="testimonial-content">
               <p>&ldquo;I just visited the <em>Fred Animal Shelter</em> to see the cats they had available and ended up bringing one home that day!&rdquo;</p>
               <p>&mdash; Lisa, 11th Grade, Jamestown NY</p>
            </div>
         </div>
         <div class="testimonial-box">
            <img src="../images/sp_student4.png" alt="stud_4" />
            <div class="testimonial-content">
               <p>&ldquo;Finding a pet has never been easier than it is at the <em>Fred Animal Shelter</em>.&rdquo;</p>
               <p>&mdash; Karen, 9th Grade, Dunkirk NY</p>
            </div>
         </div>
      </div>
      
      <!-- Third row of testimonials -->
      <div class="testimonial-row">
         <div class="testimonial-box">
            <img src="../images/sp_student5.png" alt="stud_5" />
            <div class="testimonial-content">
               <p>&ldquo;The way this place matches you to your perfect animal is such a cool idea!&rdquo;</p>
               <p>&mdash; Gianna, 10th Grade, Fredonia NY</p>
            </div>
         </div>
         <div class="testimonial-box">
            <img src="../images/sp_student6.png" alt="stud_6" />
            <div class="testimonial-content">
               <p>&ldquo;Adopting a pet from the <em>Fred Animal Shelter</em> was the best thing I could have ever done.&rdquo;</p>
               <p>&mdash; Todd, 12th Grade, Jamestown NY</p>
            </div>
         </div>
      </div>
   </div>

   <!-- Footer -->
   <footer>
        <p>Fred Animal Shelter; &copy; 2025 All Rights Reserved</p>
        <p>Email: <a href="mailto:info@fredshelter.org">info@fredshelter.org</a></p>
        <p>Phone: <a href="tel:1234567890">(123) 456-7890</a></p>
        <p>Address: 1234 Furry Street, Fredonia, NY 14063</p>
    </footer>
</body>
</html>