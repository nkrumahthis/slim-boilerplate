<?php

use \Slim\App;
use \Slim\Container;

require 'vendor/autoload.php';

$app = new App;

$container = $app->getContainer();

//add universal variables here as $container[$variable] = value
$container['db'] = require __DIR__.'\src\connection.php';
$container['title'] = "API Name Here";

//all routes go into routes.php
$routes = require __DIR__.'\src\routes.php';
$routes($app);

$app->run();
