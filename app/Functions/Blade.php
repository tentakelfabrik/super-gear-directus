<?php

/**
 *  fake function for blade @inject
 *
 *  @param  string $class
 *  @return object
 */
function app($class)
{
    return new $class();
}

/**
 *  function similar to blade asset
 *
 *  @param $path
 *  @return string
 *
 */
function asset($path, $prefix = '/public')
{
    // get flight
    $app = Flight::app();

    // getting basePath
    $basePath = $app->get('basePath');

    // path to mix-manifest
    $file = $app->get('basePath').'mix-manifest.json';

    if (file_exists($file)) {
        $manifest = file_get_contents($file);
        $files = json_decode($manifest, true);

        if (isset($files[$prefix.$path])) {
            $path = str_replace($prefix, '', $files[$prefix.$path]);
        }
    }

    return $path;
}
