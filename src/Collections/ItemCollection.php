<?php

namespace SuperGear\Directus\Collections;

/**
 * endpoint "items" for directus
 *
 *
 * @author Björn Hase
 * @license http://opensource.org/licenses/MIT The MIT License
 * @link https://gitlab.tentakelfabrik.de/super-gear/directus GitHub Repository
 *
 */
class ItemCollection extends AbstractCollection
{
    /**
     *
     *  @param string $url
     *  @param string $token
     */
    public function __construct($url, $token)
    {
        // adding endpoint for items
        $this->endpoint = '/items';

        parent::__construct($url, $token);
    }
}
