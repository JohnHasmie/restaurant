<?php  
$user = new Auth();

// Check status login user 
if ($user->isLoggedIn()) {
    header("location: ./pages/dashboard.php"); //redirect to index 
}