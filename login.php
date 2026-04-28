<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="background-color: aliceblue;">
    <!-- Header helps making SEO better. It gives primary info for search results -->
    <?php
    include "header.php";
    ?>
    

    <main style="display: flex; align-items: center; justify-content: center; margin-top: 100px; flex-direction: column;">

        <h1>Login</h1>
        <div>

            <input type="email" placeholder="Enter Your Email" style="padding: 10px; margin: 10px;">
            <br>
            <input type="password" placeholder="Enter Your Password" style="padding: 10px; margin: 10px;">
        </div>
<br>
        <div>
            <button class="button" style="margin-top: 10px;">
                Login
            </button>
        </div>

        <div style="display: flex; flex-direction: row; align-items: center;">
            <p style="padding: 3px;">Don't have an account ?</p><a href="signup.php" style="text-decoration: underline;">SignUp</a>
        </div>
    </main>
    <?php
    include "footer.php";
    ?>
</body>
</html>