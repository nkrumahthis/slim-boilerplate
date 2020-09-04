<?php

use Slim\App;

return function (App $app) {

    $app->get('/', function ($request, $response, $args) {
        $response->write('welcome to ' . $this->title);
        return $response;
    });

    // API groups
    $app->group('/users', require __DIR__.'/groups/users.php');
    $app->group('/table1', require __DIR__.'/groups/table1.php');
    $app->group('/table2', require __DIR__.'/groups/table2.php');
    $app->group('/table3', require __DIR__.'/groups/table3.php');
    
};
