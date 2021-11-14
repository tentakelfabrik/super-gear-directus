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

class PostRepository extends RepositoryAbstract
{
    /** endpoint */
    protected $endpoint = 'posts';

    /**
     *
     */
    public function find($limit = 20)
    {
        return $this->queryBuilder
            ->fields([
                'title',
                'slug',
                'lead',
                'content',
                'view',
                'date_created',
                'published_at',
                'media_teaser.id',
                'media_teaser.description'
            ])
            ->aliases('template', 'view')
            ->filter([
                'status' => 'published',
                'published_at' => [
                    '_nnull' => 'true'
                ]
            ])
            ->sort(['published_at'])
            ->find();
     }

    /**
     *  find single page with a slug,
     *  page must be published
     *
     *  @param  string $slug
     *  @return array
     */
    public function findOneBySlug($slug)
    {
        return $this->queryBuilder
            ->fields([
                'title',
                'slug',
                'lead',
                'content',
                'view',
                'meta',
                'date_created',
                'published_at',
                'media_teaser.id',
                'media_teaser.description',
                'media_hero.id',
                'media_hero.description',
            ])
            ->aliases('template', 'view')
            ->filter([
                'status' => 'published',
                'published_at' => [
                    '_nnull' => 'true'
                ],
                'slug' => $slug
            ])
            ->findOne();
    }
}
