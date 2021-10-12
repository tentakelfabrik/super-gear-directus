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

/**
 *  getting name of view as slug
 *
 *  @param  array $page
 *  @return string
 *
 */
function viewName(array $page)
{
    $slugify = new \Cocur\Slugify\Slugify();
    return $slugify->slugify($page['data']['view']);
}

/**
 *  getting name of view as slug
 *
 *  @param  array $page
 *  @return string
 *
 */
function canonical()
{
    if (isset($_SERVER['HTTPS'])) {
        $canoncial = 'https';
    } else {
        $canoncial = 'http';
    }

    $canoncial .= '://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

    return $canoncial;
}
