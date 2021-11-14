<?php

namespace App\Controllers;

use App\Controllers\DirectusControllerAbstract;
use App\Repositories\SiteRepository;
use App\Repositories\PostRepository;

/**
 *  controller for render feed of posts
 *
 *
 *  @author Björn Hase, Tentakelfabrik
 *  @license http://opensource.org/licenses/MIT The MIT License
 *  @link https://gitea.tentakelfabrik.de/Tentakelfabrik/super-gear-directus
 *
 */
class FeedController extends DirectusControllerAbstract
{
    private $limit = 20;

    /**
     *
     */
    protected $page = [
        'data' => [
            'view' => 'rss'
        ]
    ];

    /**
     *  get single page from slug
     *
     *
     *  @param string $slug
     */
    public function indexAction()
    {
        $siteRepository = new SiteRepository();
        $site = $siteRepository->findOne();

        $postRepository = new PostRepository();
        $posts = $postRepository->find($this->limit);

        // change type
        header('Content-Type: text/xml');

        $this->render($this->page, [
            'site' => $site,
            'posts' => $posts
        ]);
    }
}
