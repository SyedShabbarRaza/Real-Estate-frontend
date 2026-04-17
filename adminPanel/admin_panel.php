<?php
session_start();
// Simple admin authentication (you can later add login)
// For now, we'll assume admin is logged in. But add a basic check:
// if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
//     // Redirect to admin login page (create admin_login.html)
//     header('Location: admin_login.html');
//     exit;
// }

$host = 'localhost';
$dbname = 'real_estate_db';
$username = 'root';
$password = '';

$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Handle approval or rejection
if (isset($_GET['approve'])) {
    $id = (int)$_GET['approve'];
    $stmt = $pdo->prepare("UPDATE property SET status = 'approved' WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: admin_panel.php');
    exit;
}
if (isset($_GET['reject'])) {
    $id = (int)$_GET['reject'];
    $stmt = $pdo->prepare("UPDATE property SET status = 'rejected' WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: admin_panel.php');
    exit;
}

// Fetch pending properties
$stmt = $pdo->query("SELECT * FROM property WHERE status = 'pending' ORDER BY created_at DESC");
$pending_properties = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header class="header">
        <div class="first-div">
            <div class="logo-title">
                <img src="../assets/logo.jpeg" alt="Logo" style="height: 80px;border-radius:45px"">
                <a href="../index.php" class="title">REAL ESTATE</a>
            </div>
            <div class="search-bar">
                <input style="width: 300px; border-radius: 5px; height: 35px;" type="text" placeholder="Search...">
                <button style="height: 35px; width: 35px;">🔍</button>
            </div>
            <nav>
                <ul class="navbar">
                    <li class="li"><a href="logout.php">LogOut</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <h1 style="font-weight: bold; text-align: center;">Pending Approvals</h1>

        <?php if (count($pending_properties) === 0): ?>
            <p style="text-align: center;">No pending properties.</p>
        <?php else: ?>
            <?php foreach ($pending_properties as $prop): ?>
            <div style="margin-bottom: 15px; background-color: aquamarine; padding: 10px; display: flex; align-items: center; gap: 20px;">
                <img src="../<?= htmlspecialchars($prop['image_path'] ?: '../assets/logo.jpeg') ?>" alt="Property" style="height: 100px; width: 100px; object-fit: cover;">
                <div style="flex: 1;">
                    <strong><?= htmlspecialchars($prop['title']) ?></strong>
                    <p><?= htmlspecialchars(substr($prop['description'], 0, 100)) ?>...</p>
                    <small>Rooms: <?= $prop['rooms'] ?> | Type: <?= ucfirst($prop['type']) ?> | Phone: <?= htmlspecialchars($prop['phone']) ?></small>
                </div>
                <div>
                    <a href="details.php?id=<?= $prop['id'] ?>" style="margin-right: 10px;">See Detail</a>
                    <a href="?approve=<?= $prop['id'] ?>" class="button" style="background: green; color: white; padding: 5px 10px; text-decoration: none; border-radius: 5px;">Approve</a>
                    <a href="?reject=<?= $prop['id'] ?>" class="button" style="background: red; color: white; padding: 5px 10px; text-decoration: none; border-radius: 5px;">Reject</a>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </main>

    <footer>
        <div class="footer-content">
            <p>&copy; 2025 Real Estate Hub. All rights reserved.</p>
            <p>Contact: info@realestatehub.com</p>
        </div>
    </footer>
</body>
</html>