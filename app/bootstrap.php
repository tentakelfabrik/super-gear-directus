<?php

// adding functions
require_once(__DIR__.'/Functions/Blade.php');

// adding env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

// display all errors if debug is true
if ($_ENV['APP_DEBUG'] === true) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

// create app
$flight = Flight::app();

// setting view path
$flight->set('flight.views.path', __DIR__.'/../resources/views');

// adding blade for templates
$flight->register('view', 'Jenssegers\Blade\Blade', [ $flight->get('flight.views.path'),  __DIR__.'/../storage/cache']);
$flight->map('render', function($view, $data) {
    echo Flight::view()->make($view, $data);
});

// setting path
$flight->set('basePath', __DIR__.'/../');
$flight->set('publicPath', __DIR__.'/../public');
$flight->set('storagePath', __DIR__.'/../storage');

// adding pirectus
$flight->register('pirectus', 'Pirectus\Pirectus', [ $_ENV['DIRECTUS_API_URL'],  [
        'auth' => new \Pirectus\Auth\TokenAuth($_ENV['DIRECTUS_API_TOKEN'])
    ]
]);