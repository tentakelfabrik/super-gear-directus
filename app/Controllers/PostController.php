<?php

namespace App\Controllers;

use App\Controllers\DirectusControllerAbstract;
use App\Repositories\PostRepository;

/**
 *  controller for page items from directus
 *
 *
 *  @author Björn Hase, Tentakelfabrik
 *  @license http://opensource.org/licenses/MIT The MIT License
 *  @link https://gitea.tentakelfabrik.de/Tentakelfabrik/super-gear-directus
 *
 */
class PostController extends DirectusControllerAbstract
{
    /**
     *  get single page from slug
     *
     *
     *  @param string $slug
     */
    public function getAction($slug)
    {
        $repository = new PostRepository();
        $post = $repository->findOneBySlug($slug);

        if (count($post['data']) === 0) {
            $this->app->redirect('/404');
        } else {
            $this->render($post);
        }
    }
}
