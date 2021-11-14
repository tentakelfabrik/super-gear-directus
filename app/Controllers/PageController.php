<?php

namespace App\Controllers;

use App\Controllers\DirectusControllerAbstract;
use App\Repositories\PageRepository;

/**
 *  controller for page items from directus
 *
 *
 *  @author Björn Hase, Tentakelfabrik
 *  @license http://opensource.org/licenses/MIT The MIT License
 *  @link https://gitea.tentakelfabrik.de/Tentakelfabrik/super-gear-directus
 *
 */
class PageController extends DirectusControllerAbstract
{
    /** default view */
    protected $defaultView = 'page/default';

    /** 404 */
    protected $page404 = [
        'data' => [
            'title' => '404',
            'slug' => '404',
            'view' => 'page/404'
        ]
    ];

    /**
     *  get single page from slug
     *
     *
     *  @param string $slug
     */
    public function getAction($slug = NULL)
    {
        $pageRepository = new PageRepository();
        $page = $pageRepository->findOneBySlug($slug);

        if (count($page['data']) === 0) {
            $this->app->redirect('/404');
        } else {
            $this->render($page);
        }
    }

    /**
     * if page not found
     *
     */
    public function notFoundAction()
    {
        $this->render($this->page404);
    }
}
