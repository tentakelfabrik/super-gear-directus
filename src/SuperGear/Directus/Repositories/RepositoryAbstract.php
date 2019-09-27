<?php

namespace SuperGear\Repositories;

use SuperGear\DirectusClient\Collections\ItemCollection;

/**
 * Abstract Repository to wrap ItemCollection
 *
 *
 * @author Björn Hase
 * @license http://opensource.org/licenses/MIT The MIT License
 * @link https://gitlab.tentakelfabrik.de/super-gear/super-gear-directus GitHub Repository
 */
abstract class RepositoryAbstract
{
    /** name of the collection */
    protected $name;

    /** client for itemCollection */
    protected $itemCollection;

    /**
     *
     *
     */
    public function __construct()
    {
        if (!$this->name) {
            throw new \Exception('$name is not set!');
        };

        $this->itemCollection = new ItemCollection(
            env('DIRECTUS_API_URL'),
            env('DIRECTUS_API_TOKEN')
        );
    }
}
