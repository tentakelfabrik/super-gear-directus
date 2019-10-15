# Super Gear Directus

Small Libary to request Directus API. Works with [http://flightphp.com/](Flight).

## Install

```bash
composer require tentakelfabrik/super-gear-directus
```

## Requirements

For handle token and url for the Directus Server you have to use
[https://github.com/vlucas/phpdotenv](vlucas/phpdotenv),

```php
env('DIRECTUS_API_URL'),
env('DIRECTUS_API_TOKEN')
```

## Controller

Example how to use SuperGear\\Directus\\Controllers\\DirectusControllerAbstract,

```php
class PageController extends DirectusControllerAbstract
{
    /** slug for home */
    const HOME_SLUG = 'home';

    /** set default view */
    protected $defaultView = 'page/default';

    /**
     * get home page from slug
     *
     *
     */
    public function indexAction()
    {
        $repository = Manager::get('Page');
        $page = $repository->findOneBySlug(self::HOME_SLUG);

        if ($this->notFound($page)) {
            $this->app->redirect('404');
        }

        $this->render($page);
    }

    /**
     *  get single page from slug
     *
     *
     *  @param string $slug
     */
    public function getAction($slug)
    {
        $repository = Manager::get('Page');
        $page = $repository->findOneBySlug($slug);

        if ($this->notFound($page)) {
            $this->app->redirect('404');
        }

        $this->render($page);
    }

    /**
     * if page not found
     *
     */
    public function notFoundAction()
    {
        $page = [
            'data' => [
                'view' => 'page/404'
            ]
        ];

        $this->render($page);
    }
}
```

## Repositories

Example to use the SuperGear\\Directus\\Respositories\\RepositoryAbstract,

```PHP
class PageRepository extends RepositoryAbstract
{
    /** name of the collection */
    protected $name = 'page';

    /**
     *  find single page with a slug,
     *  page must be published
     *
     *  @param  string $slug
     *  @return array
     */
    public function findOneBySlug($slug)
    {
        return $this->itemCollection->findOne($this->name, [
            'filter[slug][eq]' => $slug,
            'filter[status][eq]' => 'published'
        ]);
    }

    /**
     *  find single page with a slug,
     *  page must be published
     *
     *  @param  string $slug
     *  @return array
     */
    public function findByView($view)
    {
        return $this->itemCollection->find($this->name, [
            'filter[view][eq]' => $view,
            'filter[status][eq]' => 'published'
        ]);
    }
}
```
