<?php

namespace App\Repositories;

use App\Repositories\RepositoryAbstract;

/**
 *  request pages items from directus
 *
 *  @author Björn Hase, Tentakelfabrik
 *  @license http://opensource.org/licenses/MIT The MIT License
 *  @link https://gitea.tentakelfabrik.de/Tentakelfabrik/super-gear-directus
 *
 */

class SiteRepository extends RepositoryAbstract
{
    /** endpoint */
    protected $endpoint = 'site';

    /**
     *  find single page with a slug,
     *  page must be published
     *
     *  @param  string $slug
     *  @return array
     */
    public function findOne()
    {
        return $this->queryBuilder
            ->fields([
                'title', 'description', 'logo'
            ])
            ->aliases('logo[id]', 'logo')
            ->findOne();
    }
}
