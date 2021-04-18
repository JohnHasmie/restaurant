<?php

require_once '../../vendor/autoload.php';

$user = new Auth();

if (!$user->isLoggedIn()) {
    header("location: ../../index.php"); //redirect to index 
}

if (isset($_POST['payment'])) {
    $payment = $_POST['payment'];
    $payment = new Payment($payment, $_POST);
    return $payment->placeOrder();
}