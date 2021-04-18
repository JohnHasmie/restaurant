<?php

$user = new Auth();

if (!$user->isLoggedIn()) {
    header("location: ../../index.php"); //redirect to index 
}

$restaurantId = false;

if (isset($_GET['id'])) {
    $restaurantId = $_GET['id'];
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
        header('Location: ../../pages/menu/product.php?id='.$restaurantId);    
    } else {
        header('Location: ../../pages/menu/product.php');
    }
}
