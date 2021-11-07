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

/**
 *  getting title for head
 *
 *  @param  array $page
 *  @param  array $site
 *  @return string
 */
function title($page, $site)
{
    $title = [];

    if ($site['data']['title']) {
        $title[] = $site['data']['title'];
    }

    // if not homepage set page title first
    if ($page['data']['slug']) {
        array_unshift($title, $page['data']['title']);
    } else {
        $title[] = $page['data']['title'];
    }

    return join(' | ', $title);
}

/**
 *  getting url for assets of directus api
 *
 *  @param  string string
 *  @param  array array
 *  @return string
 *
 */
function assetsUrl(string $id, array $options = NULL)
{
    $query = NULL;

    if ($options) {
        $query = '?'.http_build_query($options);
    }

    return $_ENV['DIRECTUS_API_URL'].'/assets/'.$id.$query;
}

/**
 *
 *
 *
 */
function isCurrentPage($slug, $class = 'current')
{
    // parse current url
    $url = parse_url($_SERVER['REQUEST_URI']);

    // getting path, remove first "/""
    $path = ltrim($url['path'], '/');

    // parse empty in NULL
    // @TODO bad solution, check for using parent
    if (empty($path)) {
        $path = NULL;
    }

    if ($path !== $slug) {
        $class = NULL;
    }

    return $class;
}
