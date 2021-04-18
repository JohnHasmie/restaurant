<?php

use Google_Client as Google;

class GoogleLogin extends Google
{
    private $clientID;
    private $clientSecret;
    private $redirectUri;


    public function __construct()
    {
        $this->clientID = '399472337496-l2ok56a0c2cesmtul6g4rvdmchucja6o.apps.googleusercontent.com';
        $this->clientSecret = 'diGpPfkVnAsiOoAsllKF7FLG';
        $this->redirectUri = BASE_URL.'/callback/google.cb.php';

        parent::__construct();
        $this->setClientId($this->clientID);
        $this->setClientSecret($this->clientSecret);
        $this->setRedirectUri($this->redirectUri);
        $this->addScope("email");
        $this->addScope("profile");
    }
}