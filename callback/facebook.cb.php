<?php
require_once '../vendor/autoload.php'; // change path as needed
require_once '../includes/autoload.inc.php';
session_start();

$fb = new FacebookLogin();

// Use one of the helper classes to get a Facebook\Authentication\AccessToken entity.
$helper = $fb->getRedirectLoginHelper();
//   $helper = $fb->getJavaScriptHelper();
//   $helper = $fb->getCanvasHelper();
//   $helper = $fb->getPageTabHelper();

try {
  // Get the \Facebook\GraphNodes\GraphUser object for the current user.
  // If you provided a 'default_access_token', the '{access-token}' is optional.
  $accessToken = $helper->getAccessToken();  
  $response = $fb->get('/me?fields=name,first_name,last_name,email,hometown', $accessToken);
} catch(\Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(\Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$user = $response->getGraphUser();
// Auth::setUser($user['first_name'], $user['last_name'], $user['email']);
header('Location: ../pages/register.php?firstname='.$user['first_name'].'&lastname='.$user['last_name'].'&email='.$user['email']);