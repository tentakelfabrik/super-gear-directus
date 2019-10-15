<?php

namespace SuperGear\Directus;

use Flight;

/**
 * abstract FlightAbstract get instance of flight engine
 *
 * @author Björn Hase
 * @license http://opensource.org/licenses/MIT The MIT License
 * @link https://gitlab.tentakelfabrik.de/super-gear/super-gear-directus GitHub Repository
 */
abstract class FlightAbstract
{
    /** object of flight */
    protected $app;

    /**
     *  getting object of flight
     *
     */
    public function __construct()
    {
        $this->app = Flight::app();
    }
}
