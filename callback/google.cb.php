<?php
require_once '../vendor/autoload.php';
require_once '../includes/autoload.inc.php';
  
$client = new GoogleLogin;

// authenticate code from Google OAuth Flow
$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
$client->setAccessToken($token['access_token']);

// get profile info
$google_oauth = new Google_Service_Oauth2($client);
$user = $google_oauth->userinfo->get();
// Auth::setUser($user['given_name'], $user['family_name'], $user['email']);
header('Location: ../pages/register.php?firstname='.$user['given_name'].'&lastname='.$user['family_name'].'&email='.$user['email']);