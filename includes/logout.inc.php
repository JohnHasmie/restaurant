<?php  
include '../includes/autoload.inc.php';

$user = new Auth();

$user->logout(); 
    header('location: ../index.php'); 
?> 