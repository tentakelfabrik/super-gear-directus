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

class SnippetRepository extends RepositoryAbstract
{
    /** endpoint */
    protected $endpoint = 'snippets';

    /**
     *  find single page with a slug,
     *  page must be published
     *
     *  @param  string $slug
     *  @return array
     */
    public function findByName($name)
    {
        $results = $this->queryBuilder
            ->fields([
                'title',
                'content',
                'name',
                'view',
                'file.id',
                'file.description'
            ])
            ->aliases('template', 'view')
            ->filter([
                'name' => $name
            ])
            ->find();

        return $results;
    }
}
