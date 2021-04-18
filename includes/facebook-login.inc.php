<?php
require_once 'vendor/autoload.php'; // change path as needed
// session_start();

$fb = new FacebookLogin();

// Use one of the helper classes to get a Facebook\Authentication\AccessToken entity.
$helper = $fb->getRedirectLoginHelper();
//   $helper = $fb->getJavaScriptHelper();
//   $helper = $fb->getCanvasHelper();
//   $helper = $fb->getPageTabHelper();

$permissions = ['email']; // Optional permissions
$callbackUrl = $fb->callbackUrl;
$urlLoginFB = $helper->getLoginUrl($callbackUrl, $permissions);