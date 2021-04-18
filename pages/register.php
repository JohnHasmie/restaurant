<?php
    include '../includes/autoload.inc.php';
    include '../includes/register.inc.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css" media="screen" title="no title" charset="utf-8">
</head>

<body>
    <center>
        <h2>Let's Sign Up</h2>
        <form method="POST">
            <?php if (isset($error)) : ?>
                <div style="color:red;">
                    <?php echo $error ?>
                </div>
            <?php endif; ?>
            <div style="display: flex; justify-content: center;">
                <div>
                    <b>Firstname</b>
                    <br>
                    <input type="text" name="firstname" value='<?= $firstname ?>' required />
                </div>
                <div>
                    <b>Lastname</b>
                    <br>
                    <input type="text" name="lastname" value='<?= $lastname ?>' required />
                </div>
            </div>
            <br>
            <div style="display: flex; justify-content: center;">
                <div>
                    <b>Email</b>
                    <br>
                    <input type="email" name="email" value='<?= $email ?>' required />
                </div>
                <div>
                    <b>My Location</b>
                    <br>
                    <input type="text" name="location" required />
                </div>
            </div>
            <br>
            <div style="display: flex; justify-content: center;">
                <div>
                    <b>Create Password</b>
                    <br>
                    <input type="password" name="password" required />
                </div>
                <div>
                    <b>Repeat Password</b>
                    <br>
                    <input type="password" name="password_verification" required />
                </div>
            </div>
            <br>
            <button name="login"><a href="../index.php">Cancel</a></button>
            <button type="submit" name="register">Next</button>
        </form>
    </center>
</body>

</html>