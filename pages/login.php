<?php
    include '../includes/autoload.inc.php';
    include '../includes/login.inc.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css" media="screen" title="no title" charset="utf-8">
</head>

<body>
    <center>
        <h2>Sign In</h2>
        <form method="POST">
            <?php if (isset($error)) : ?>
                <div style="color:red">
                    <?php echo $error ?>
                </div>
            <?php endif; ?>
            <b>Your Login</b>
            <br>
            <input type="email" name="email" placeholder="email" required />
            <br>
            <br>
            <b>Password</b>
            <br>
            <input type="password" name="password" placeholder="password" required />
            <br>
            <button type="submit" name="login">login</button>
            <p>Not registered? <a href="../index.php">SignUp</a></p>
        </form>
    </center>
</body>

</html>