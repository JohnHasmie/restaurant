<?php

require_once '../vendor/autoload.php';
require_once '../includes/autoload.inc.php';

$client = new Payment('Paypal', $_GET);
$client->complete($_GET);