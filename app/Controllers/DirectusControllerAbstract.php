<?php

namespace App\Controllers;

use App\Flight\FlightAbstract;
use Exception;

/**
 *  abstract controller to handle views and response from directus
 *
 *
 *  @author Björn Hase, Tentakelfabrik
 *  @license http://opensource.org/licenses/MIT The MIT License
 *  @link https://gitea.tentakelfabrik.de/Tentakelfabrik/super-gear-directus
 *
 */
abstract class DirectusControllerAbstract extends FlightAbstract
{
    /** default template for view */
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
        $result = false;

        if (file_exists($this->app->get('flight.views.path').'/'.$view.'.blade.php')) {
            $result = true;
        }

        return $result;
    }

    /**
     *
     *  @param  [type] $page [description]
     *  @param  array  $data [description]
     *  @return [type]       [description]
     */
    protected function render($page, $data = [])
    {
        $view = $this->defaultView;

        // if view isset in page and file exists
        if (isset($page['data']['view'])) {
            if ($this->viewExists($page['data']['view'])) {
                $view = $page['data']['view'];
            } else {
                throw new Exception('View '.$page['data']['view'].' not exists');
            }
        } else if (!$this->viewExists($view)) {
            throw new Exception('View '.$view.' not exists');
        }

        $this->app->render($view, array_merge([
                'page' => $page,
                'flight' => $this->app
            ],
            $data
        ));
    }
}
