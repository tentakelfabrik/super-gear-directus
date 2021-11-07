<?php

namespace App\Repositories;

use App\Repositories\RepositoryAbstract;

/**
 *  request menu items from a menu
 *
 *  @author Björn Hase, Tentakelfabrik
 *  @license http://opensource.org/licenses/MIT The MIT License
 *  @link https://gitea.tentakelfabrik.de/Tentakelfabrik/super-gear-directus
 *
 */

class MenuRepository extends RepositoryAbstract
{
    /** endpoint */
    protected $endpoint = 'menu_items';

    /**
     *  find menu_items by name of menu
     *  menu must be published
     *
     *  @param  string $slug
     *  @return array
     */
    public function findByName($name)
    {
        $results = $this->queryBuilder
            ->fields([
                'title',
                'target',
                'url',
                'page.title',
                'page.status',
                'page.slug',
                'menus.sort',
                'menus.menus_id.name'
            ])
            ->aliases('page[title]', 'page_title')
            ->aliases('page[status]', 'page_status')
            ->aliases('page[slug]', 'page_slug')
            ->filter([
                '_or' => [
                    [
                        '_and' => [
                            [ 'page' => [
                                'id' => [
                                    '_null' => 'true'
                                ]
                            ]],
                            [ 'menus' => [
                                'menus_id' => [
                                    'name' =>  $name,
                                    'status' => 'published'
                                ]
                            ]]
                        ]
                    ],
                    [
                        '_and' => [
                            [ 'page' => [
                                'status' => 'published'
                            ]],
                            [ 'menus' => [
                                'menus_id' => [
                                    'name' =>  $name,
                                    'status' => 'published'
                                ]
                            ]]
                        ]
                    ],
                ]
            ])
            ->find();

        // @TODO Workaround sort functions seems have problems with relationals fields
        if (count($results['data'])) {
            usort($results['data'], function($a, $b) {
                return ($a['menus'][0]['sort'] > $b['menus'][0]['sort']);
            });
        }

        return $results;
    }
}
