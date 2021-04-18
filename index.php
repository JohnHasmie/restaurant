<?php
    include 'includes/autoload.inc.php';
    include 'includes/index.inc.php';
    include 'includes/facebook-login.inc.php';
    include 'includes/google-login.inc.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant</title>
    <link rel="stylesheet" href="style.css" media="screen" title="no title" charset="utf-8">
</head>

<body>
    <center>
        <h2>Sign Up</h2>
        <br>
        <button><a href="pages/register.php">With Email</a></button>
        <br>
        <br>
        <button><a href='<?= $urlLoginFB ?>'>With Facebook</a></button>
        <br>
        <br>
        <button><a href='<?= $urlLoginGoogle ?>'>With Gmail</a></button>
        <br>
        <p>Already Have an Account ? <a href="pages/login.php">Sign In</a></p>
    </center>
</body>

</html>