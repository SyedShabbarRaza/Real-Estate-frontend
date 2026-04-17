<?php
$host='localhost';
$dbname='real_estate_db';
$username='root';
$password='';


$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$username,$password);
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

//Only fetch the approved properties
$stmt=$pdo->query("SELECT * FROM property WHERE status ='approved' ORDER BY created_at DESC");
$properties=$stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<title>
    Real Estate
</title>

<link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Header helps making SEO better. It gives primary info for search results -->
<header class="header">
        <div class="first-div">
            <!-- LOGO-TITLE -->
            <div class="logo-title">
                <img src="assets/logo.jpeg" alt="Logo" style="height: 80px;border-radius:45px">
                <a href="index.php" class="title">REAL ESTATE</a>
            </div>
            <!-- SearchBar -->
        <div class="search-bar">
            <input style="width: 300px; border-radius: 5px; height: 35px;" type="text" placeholder="Search by location or price...">
            <button style="height: 35px; width: 35px;">🔍</button>
        </div>
        <!-- navbar -->
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


  <main>

    <!-- section will divide the different parts -->
    
    <section>

    <div class="onboarding">

            <h2>Best Online Platform</h2>
        <p class="paragraph">One of the best online platform for property sales and purchase.Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus sit quasi voluptate illo? Labore ipsum error numquam, repudiandae pariatur dolore, similique maxime, possimus repellendus neque ipsa repellat earum nulla adipisci.</p>

        <button class="button">Explore.</button>
</div>

    </section>
    
    <section class="properties" >
        <h3 >Featured Properties</h3>
        <div class="property-grid">
            
        <?php if(count($properties)===0): ?>
            <p>No approved properties yet.</p>
        
        <?php else: ?>
            <?php foreach ($properties as $prop): ?>
<div class="property-card">
    <img src="<?=htmlspecialchars($prop['image_path']?:'./assets/home.jpeg') ?>" alt="Property" style="padding:10px;max-height:300px">
    <div class="card-content">
        <h3><?= htmlspecialchars($prop['title'])?></h3>
        <p class="price"><?= ucfirst($prop['type'])?></p>
        <p class="location"><?= htmlspecialchars($prop['address'])?></p>
        <p class="description"><?= htmlspecialchars(substr($prop['description'],0,100))?></p>
        
        <p>Rooms: <?= $prop['rooms']?></p>
        <p>Contact: <?= htmlspecialchars($prop['email'])?></p>
        <br>
        <a href="details.php?id=<?= $prop['id'] ?>" class="link-button" >View Details</a>

    </div>
</div>

<?php endforeach; ?>
<?php endif; ?>

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