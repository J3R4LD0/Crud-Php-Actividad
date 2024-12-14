<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../bootstrap.php';

use Routes\Api;
use Routes\Web;

$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$uri = rtrim($uri, '/') . '/';

if (strpos($uri, 'api/') === 0) {
        
    $_SERVER['REQUEST_URI'] = '/' . substr($uri, 4); 
    Api::handle();
    
} else {
    
    Web::handle();
}

Flight::start();