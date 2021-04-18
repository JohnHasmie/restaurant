<?php

use \Facebook\Facebook as Facebook;

class FacebookLogin extends Facebook
{
    public $callbackUrl;
    public function __construct()
    {
        $this->callbackUrl = htmlspecialchars(BASE_URL.'/callback/facebook.cb.php');

        parent::__construct([
            'app_id' => '494033088440501',
            'app_secret' => '9944be159ee820cce6f679e87b5d4a68',
            'default_graph_version' => 'v3.2',
            //'default_access_token' => '{access-token}', // optional
        ]);
    }
}