<?php

define('BASE_URL', 'http://localhost/restaurant');
define('BASE_PATH', '/var/www/html/restaurant');

spl_autoload_register('autoloader');

function autoloader ($className) {
    // $path = 'classes';
    $path = BASE_PATH.'/classes/';
    $extension = '.class.php';
    $fileName = $path . $className . $extension;

    if (!file_exists($fileName)) {
        return false;
    }

    include_once $path . $className . $extension;
}