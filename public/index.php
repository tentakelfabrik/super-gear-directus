<?php

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../app/bootstrap.php';

// default routes
$flight->route('GET /404', array(new App\Controllers\PageController, 'notFoundAction'));
$flight->route('GET /(@slug:[a-zA-Z0-9_-])', array(new App\Controllers\PageController, 'getAction'));

$flight->start();
