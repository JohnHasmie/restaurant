<?php

$user = new Auth();

if (!$user->isLoggedIn()) {
    header("location: ../../index.php"); //redirect to index 
}

$restaurantId = false;
$restaurant = new stdClass();
$menu = isset($_GET['menu']) && $_GET['menu'] ? $_GET['menu'] : false;

if (isset($_GET['id']) && $_GET['id']) {
    $restaurantId = $_GET['id'];
    $restaurant = new Restaurant;
    $restaurant = $restaurant->getById($restaurantId);
}

$product = new Product;
$products = $product->getAll($restaurantId);

$order = new Order();
$orders = $order->getAll();

// handle order product
if (isset($_POST['product']) && isset($_POST['price'])) {
    $productId = $_POST['product'];
    $price = $_POST['price'];

    $order->orderProduct($productId, $price);

    // prevent resubmit page
    if ($restaurantId) {
        header('Location: ../../pages/menu/product.php?id='.$restaurantId.'&menu='.$menu);    
    } else {
        header('Location: ../../pages/menu/product.php');
    }
}
