<?php

namespace App\Repositories;

/**
 *
 *
 *  @author Björn Hase, Tentakelfabrik
 *  @license http://opensource.org/licenses/MIT The MIT License
 *  @link https://gitea.tentakelfabrik.de/Tentakelfabrik/super-gear-directus
 *
 */

abstract class RepositoryAbstract
{
    /** endpoint for request */
    protected $endpoint;

    /** queryBuilder from pirectus */
    protected $queryBuilder;

    /**
     *
     *
     */
    public function __construct()
    {
        $pirectus = \Flight::pirectus();

        if ($pirectus) {
            $this->queryBuilder = $pirectus->items($this->endpoint);
        } else {
            throw new \Exception('Error! Pirectus not initialized!');
        }
    }
}