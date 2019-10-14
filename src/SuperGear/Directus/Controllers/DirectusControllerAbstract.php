<?php

namespace SuperGear\Directus\Controllers;

use SuperGear\Directus\FlightAbstract;
use Exception;

/**
 * abstract controller to handle views and response from directus
 *
 *
 * @author Björn Hase
 * @license http://opensource.org/licenses/MIT The MIT License
 * @link https://gitlab.tentakelfabrik.de/super-gear/directus GitHub Repository
 *
 */
abstract class DirectusControllerAbstract extends FlightAbstract
{
    protected $defaultView = NULL;

    /**
     *  if item not found
     *
     *  @param  string $page
     *  @return boolean
     */
    protected function notFound($item)
    {
        return (!$item || ($item && isset($item['error']) && $item['error']['code'] === 203));
    }

    /**
     *
     *  @param  string $view
     *  @return boolean
     */
    protected function viewExists($view)
    {
        return file_exists($this->app->get('flight.views.path').'/'.$view.'.blade.php');
    }

    /**
     *
     *  @param  [type] $page [description]
     *  @param  array  $data [description]
     *  @return [type]       [description]
     */
    protected function render($item, $data = [])
    {
        $view = $this->defaultView;

        // if view isset in page and file exists
        if (isset($item['data']['view'])) {
            if ($this->viewExists($item['data']['view'])) {
                $view = $item['data']['view'];
            } else {
                throw new Exception('View '.$item['data']['view'].' not exists');
            }
        } else if (!$this->viewExists($view)) {
            throw new Exception('View '.$view.' not exists');
        }

        $this->app->render($view, array_merge([
                'page' => $item
            ],
            $data
        ));
    }
}
