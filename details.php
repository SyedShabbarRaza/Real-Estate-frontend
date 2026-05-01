<?php
include "config.php";

// Get the property ID from URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;//pehly humne id ko get kiya url se, aur usko integer me convert kiya. Aggar value aye to theek warna id=0


if ($id <= 0) {
    die("Invalid property ID.");
}

// Fetch property details
$sql = "SELECT * FROM property WHERE id = $id";
$result=$conn->query($sql);

$property = $result->fetch_assoc();

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
<?php
include "header.php";   
?>
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

    <?php
    include "footer.php";
    ?>
</body>
</html>