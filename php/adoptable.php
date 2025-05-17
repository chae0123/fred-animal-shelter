<?php
// adoptable.php
require_once 'db.php';

// Fetch available pets from the database
$pets = [];
$result = $conn->query("SELECT name, species, breed, age, image_url FROM pets WHERE status = 'available'");
while ($row = $result->fetch_assoc()) {
    $pets[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adoptable Animals</title>
    <link href="../css/base.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
    <link href="../css/layout.css" rel="stylesheet">
</head>
<body>
    <img id="logo" src="../images/fred_animal_shelter_logo.png" alt="Fred Animal Shelter" />

    <nav class="horizontal">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="../about.html">About</a></li>
            <li><a href="donate.php">Donate</a></li>
            <li class="dropdown active">
                <a href="#">Adopt</a>
                <ul class="dropdown-menu">
                    <li><a href="adoptable.php">Adoptable Animals</a></li>
                    <li><a href="adopt.php">Application</a></li>
                </ul>
            </li>
            <li><a href="volunteer.php">Volunteer</a></li>
        </ul>
    </nav>

    <div class="form-container">
        <h1>Meet Our Adoptable Animals</h1>
        <p>These loving pets are looking for their forever homes!</p>

        <div class="adoptable-container">
            <?php if (count($pets) > 0): ?>
                <?php foreach ($pets as $pet): ?>
                    <div class="pet-card">
                        <img src="../<?php echo htmlspecialchars($pet['image_url']); ?>" alt="<?php echo htmlspecialchars($pet['name']); ?>">
                        <h3><?php echo htmlspecialchars($pet['name']); ?></h3>
                        <p><strong>Species:</strong> <?php echo htmlspecialchars($pet['species']); ?></p>
                        <p><strong>Breed:</strong> <?php echo htmlspecialchars($pet['breed']); ?></p>
                        <p><strong>Age:</strong> <?php echo htmlspecialchars($pet['age']); ?> years old</p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No pets currently available for adoption. Please check back later!</p>
            <?php endif; ?>
        </div>
        <div style="text-align: center; margin-top: 10px; margin-bottom: 20px;">
            <a href="adopt.php">
                <button style="
                    background-color: #2c67e3;
                    color: white;
                    padding: 12px 24px;
                    font-size: 2rem;
                    border: none;
                    border-radius: 10px;
                    cursor: pointer;
                ">
                Apply for Adoption
                </button>
            </a>
        </div>

    </div>

    <footer>
        <p>Fred Animal Shelter; &copy; 2025 All Rights Reserved</p>
        <p>Email: <a href="mailto:info@fredshelter.org">info@fredshelter.org</a></p>
        <p>Phone: <a href="tel:1234567890">(123) 456-7890</a></p>
        <p>Address: 1234 Furry Street, Fredonia, NY 14063</p>
    </footer>
</body>
</html>
