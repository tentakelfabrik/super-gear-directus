<?php

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../app/bootstrap.php';

// make sure that all routes with a slug and ending with a "/" redirect to a route without
$flight->route('GET /@slug:[a-z0-9\-]+/$', function() use ($flight) {

    // getting position and build route
    $position = strlen($flight->request()->url) - 1;
    $route = substr_replace($flight->request()->url, '', $position, 1);

    $flight->redirect($route, 301);
});

$flight->route('GET /404', array(new App\Controllers\PageController, 'notFoundAction'));
$flight->route('GET /feed', array(new App\Controllers\FeedController, 'indexAction'));

$flight->route('GET /blog/@slug:[a-z0-9\-]+$', array(new App\Controllers\PostController, 'getAction'));
$flight->route('GET /(@slug:[a-z0-9\-]+$)', array(new App\Controllers\PageController, 'getAction'));

$flight->start();

try {
    $flight->start();
} catch (\Exception $exception) {
    echo $exception->getMessage();
}
