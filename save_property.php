<?php
// Database connection settings
$host = 'localhost';
$dbname = 'real_estate_db';
$username = 'root';
$password = ''; // Leave empty if you have no MySQL password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize input
    $title = htmlspecialchars(trim($_POST['title']));
    $description = htmlspecialchars(trim($_POST['description']));
    $rooms = (int)$_POST['rooms'];
    $type = $_POST['type'] === 'rent' ? 'rent' : 'sale';
    $address = htmlspecialchars(trim($_POST['address']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $email = htmlspecialchars(trim($_POST['email'])); // we'll store this too – you may want to add column later

    // Handle image upload
    $image_path = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/';
        // Ensure directory exists
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $file_extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (in_array($file_extension, $allowed_extensions)) {
            $unique_name = uniqid() . '.' . $file_extension;
            $destination = $upload_dir . $unique_name;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
                $image_path = $destination;
            } else {
                // Upload failed
                $error = "Failed to move uploaded file.";
            }
        } else {
            $error = "Invalid file type. Only JPG, PNG, GIF, WEBP allowed.";
        }
    }

    
    $sql = "INSERT INTO property (title, description, rooms, type, address, phone, email, image_path) 
            VALUES (:title, :description, :rooms, :type, :address, :phone, :email, :image_path)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':title' => $title,
        ':description' => $description,
        ':rooms' => $rooms,
        ':type' => $type,
        ':address' => $address,
        ':phone' => $phone,
        ':email' => $email,
        ':image_path' => $image_path
    ]);

    // Redirect to a success page or back to the form with a message
    header('Location: data.html?success=1');
    exit;
} else {
    // If someone accesses this script directly without POST, redirect to form
    header('Location: data.html');
    exit;
}
?>