<?php

$user = new Auth();

if ($user->isLoggedIn()) {
    header("location: ../pages/dashboard.php"); //redirect to index 
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // process login user 
    if ($user->login($email, $password)) {
        header("location: ../pages/dashboard.php");
    } else {
        // If failed login, get last error
        $error = $user->getLastError();
    }
}