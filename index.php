<?php
include "config.php";

//Only fetch the approved properties
$sql="SELECT * FROM property WHERE status ='approved' ORDER BY created_at DESC";
$result=$conn->query($sql);

//result is not set of arrays it's just a pointer to db's results after query
// now we have to seperate the rows from that poniter
$properties=[];

if($result->num_rows>0){
    while($row= $result->fetch_assoc()){
        $properties[]=$row;
    }
}
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
<?php
include "header.php";
?>


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

<?php
include "footer.php";
?>

</body>

</html>