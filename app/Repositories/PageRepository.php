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

class PageRepository extends RepositoryAbstract
{
    /** endpoint */
    protected $endpoint = 'pages';

    /**
     *  find single page with a slug,
     *  page must be published
     *
     *  @param  string $slug
     *  @return array
     */
    public function findOneBySlug($slug)
    {
        // if slug not set, search for empty slug
        if (!$slug) {
            $slug = [ '_null' => 'true' ];
        } else {
            $slug = [ '_eq' => $slug ];
        }

        return $this->queryBuilder
            ->fields([
                'title', 'slug', 'content', 'view', 'meta',
                'media_teaser.*',
                'media_hero.*'
            ])
            ->aliases('view', 'template')
            ->filter([
                'status' => 'published',
                'slug' => $slug
            ])
            ->findOne();
    }
}
