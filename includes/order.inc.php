<?php

$user = new Auth();

if (!$user->isLoggedIn()) {
    header("location: ../../index.php"); //redirect to index 
}

$order = new Order();
$orders = $order->getAll();

// handle order product
if (isset($_POST['product']) && isset($_POST['price'])) {
    $productId = $_POST['product'];
    $price = $_POST['price'];

    $order->orderProduct($productId, $price);

    // prevent resubmit page
    header('Location: ../../pages/menu/product.php');
}
