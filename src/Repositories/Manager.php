<?php

namespace SuperGear\Directus\Repositories;

use Exception;

/**
 * Manager Class to create Repository Objects that
 * are located in App\Repositories\
 *
 *
 * @author Björn Hase
 * @license http://opensource.org/licenses/MIT The MIT License
 * @link https://gitlab.tentakelfabrik.de/super-gear/super-gear-directus GitHub Repository
 */
class Manager
{
    /**
     * naming of Repository
     * @var string
     */
    const NAMESPACE = 'App\Repositories\\';

    /**
     * naming of Repository
     * @var string
     */
    const REPOSITORY_SUFFIX = 'Repository';

    /**
     * getting repository object
     *
     * @param  string $repositoryClass
     * @return AbstractRepository
     */
    public static function get($repositoryName)
    {
        $repositoryClass = self::NAMESPACE.$repositoryName.self::REPOSITORY_SUFFIX;

        if (!class_exists($repositoryClass)) {
            throw new Exception('Repository Class '.$repositoryClass.' not exists!');
        }

        // create respository object
        $repository = new $repositoryClass();

        return $repository;
    }
}
