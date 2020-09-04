<?php

use Slim\Container;

return function(Container $container){
    $getSettings = parse_ini_file(__DIR__."\..\config.ini");
    $host = $getSettings['host']; 
    $username = $getSettings['user']; 
    $passwd = $getSettings['password']; 
    $dbname = $getSettings['database'];
    $dblink = new mysqli($host, $username, $passwd, $dbname);
    return $dblink;
};