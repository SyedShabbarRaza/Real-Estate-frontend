<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Data</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="background-color: aliceblue;">
    <?php
    include "header.php";
    ?>

        <main style="display: flex; align-items: center; justify-content: center; flex-direction: column;">

        <h1>Property Details</h1>
        <!-- <div style="width: 250px; display: flex; justify-content: center; flex-direction: column; align-items: center;"> -->
    <form action="save_property.php" method="POST" enctype="multipart/form-data" style="width: 300px;">
            <input type="text" placeholder="Title" name="title" style="padding: 10px; margin: 10px;">
            <br>
        <textarea name="description" placeholder="Description" rows="4" required style="padding: 10px; margin: 10px; width: 60%;"></textarea>
            <br>
            <input type="number" placeholder="Rooms" name="rooms" style="padding: 10px; margin: 10px;">
            <br>
            <input type="number" placeholder="Price" name="price" style="padding: 10px; margin: 10px;">
            <br>
            <div style="display: flex; align-items: center;">
                <label> Rent</label>
                <input type="radio" name="type" value="Rent" required style="padding: 10px; margin: 10px;">
                <label> Sale</label>
                <input type="radio" name="type" value="Sale" required style="padding: 10px; margin: 10px;">
                
            </div>
            <br>
            <input type="text" placeholder="Enter Your Address" name="address" required style="padding: 10px; margin: 10px;">
            <br>
            <input type="text" placeholder="Phone Number" name="phone" required style="padding: 10px; margin: 10px;">
            <br>
        <input type="email" name="email" placeholder="Your Email" required style="padding: 10px; margin: 10px; width: 60%;">
        <br>


            Upload Images:
                 <input type="file" name="image" accept="image/*" style="padding: 10px; margin: 10px;">
            
        <!-- </div> -->
        <br>

            <button type="submit" class="button">
                Publish
            </button>

    </form>

    </main>

    <?php
    include "footer.php";
    ?>

</body>
</html>