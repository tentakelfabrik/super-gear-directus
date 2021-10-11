<?php

namespace App\Flight;

use Flight;

/**
 *  abstract FlightAbstract to get instance of flight engine
 *
 *  @author Björn Hase, Tentakelfabrik
 *  @license http://opensource.org/licenses/MIT The MIT License
 *  @link https://gitea.tentakelfabrik.de/Tentakelfabrik/super-gear-directus
 *
 */

abstract class FlightAbstract
{
    /** object of flight */
    protected $app;

    /**
     *  getting object of flight
     *
     *
     */
    public function __construct()
    {
        $this->app = Flight::app();
    }
}
