<?php
// Database connection
$host = 'localhost';
$dbname = 'real_estate_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Get the property ID from URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    die("Invalid property ID.");
}

// Fetch property details
$stmt = $pdo->prepare("SELECT * FROM property WHERE id = ? AND status = 'approved'");
$stmt->execute([$id]);
$property = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$property) {
    die("Property not found or not approved.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($property['title']) ?> - Property Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="background-color: aliceblue;">
    <header class="header">
        <div class="first-div">
            <div class="logo-title">
                <img src="assets/logo.jpeg" alt="Logo" style="height: 80px;border-radius:45px"">
                <a href="index.php" class="title">REAL ESTATE</a>
            </div>

            <div class="search-bar">
                <input style="width: 300px; border-radius: 5px; height: 35px;" type="text" placeholder="Search by location or price...">
                <button style="height: 35px; width: 35px;">🔍</button>
            </div>

            <nav>
                <ul class="navbar">
                    <li class="li"><a href="index.php">Home</a></li>
                    <li class="li"><a href="about.html">About</a></li>
                    <li class="li"><a href="data.html">Publish</a></li>
                    <li class="li"><a href="contact-us.html">Contact Us</a></li>
                    <!-- <li class="li"><a href="login.html">Login</a></li> -->
                </ul>
            </nav>
        </div>
    </header>

    <main class="details-main">
        <section class="details-card">
            <img src="<?= htmlspecialchars($property['image_path'] ?: 'assets/home.jpeg') ?>" alt="<?= htmlspecialchars($property['title']) ?>" class="details-image">

            <div class="details-content">
                <h1><?= htmlspecialchars($property['title']) ?></h1>
                <p><strong>Price:</strong> <?= ucfirst($property['type']) ?></p>
                <p><strong>Location:</strong> <?= htmlspecialchars($property['address']) ?></p>
                <p><strong>Rooms:</strong> <?= $property['rooms'] ?> Bed</p>
                <p><strong>Description:</strong> <?= nl2br(htmlspecialchars($property['description'])) ?></p>
                <p><strong>Contact Email:</strong> <?= htmlspecialchars($property['email']) ?></p>
                <p><strong>Phone:</strong> <?= htmlspecialchars($property['phone']) ?></p>

                <a class="button email-button" href="mailto:<?= htmlspecialchars($property['email']) ?>?subject=Inquiry%20about%20<?= urlencode($property['title']) ?>&body=Hello%2C%20I%20am%20interested%20in%20your%20property%20%22<?= urlencode($property['title']) ?>%22.%20Please%20share%20more%20details.">
                    Email Seller
                </a>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <p>&copy; 2025 Real Estate Hub. All rights reserved.</p>
            <p>Contact: info@realestatehub.com</p>
        </div>
    </footer>
</body>
</html>