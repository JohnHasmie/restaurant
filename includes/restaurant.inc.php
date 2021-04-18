<?php
require_once '../vendor/autoload.php';

$user = new Auth();

if (!$user->isLoggedIn()) {
    header("location: ../../index.php"); //redirect to index 
}

$currentLocation = '04 rue neuve de la chardonnière, 75018, Paris';

if (isset($_GET['current-location'])) {
    $currentLocation = $_GET['current-location'];
}

$restaurant = new Restaurant($currentLocation);
$restaurants = $restaurant->getAll();


