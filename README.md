# Super Gear Directus 1.0.0-rc1

Project to using a Directus Instance as CMS. Structure is inspired by Laravel, using [FlightPHP](https://github.com/mikecao/flight)
for handle Request.

## Installation

Download last Release, a Composer Installer will be Available in a Future Release.

## Snapshot

There is a Snapshot for a Basic Setup for the Directus Instance.

## Quickstart

Create a **.env** from **.env.example** adding token and url for Directus Instance.

```
DIRECTUS_API_URL=
DIRECTUS_API_TOKEN=
```

## Laravel Mix

## Repositories

For getting Data use **App\\Respositories\\RepositoryAbstract** to create Repository-Classes.
This is the default class to handle

```PHP
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
        if (!$slug) {
            $slug = [ '_null' => 'true' ];
        }

        return $this->queryBuilder
            ->fields(['title', 'slug', 'content', 'view', 'meta', 'media_teaser.*', 'media_hero.*'])
            ->aliases('view', 'template')
            ->filter([
                'status' => 'published',
                'slug' => $slug
            ])
            ->findOne();
    }
}
```

