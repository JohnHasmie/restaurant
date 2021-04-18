<?php
require_once 'vendor/autoload.php';
  
$client = new GoogleLogin;   
$urlLoginGoogle = $client->createAuthUrl();