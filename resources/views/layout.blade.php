@inject('pageRepository', 'App\Repositories\PageRepository')
@inject('siteRepository', 'App\Repositories\SiteRepository')
@inject('menuRepository', 'App\Repositories\MenuRepository')

@inject('markdownHelper', 'App\Helpers\MarkdownHelper')

@php
    $site = $siteRepository->findOne();
    $menuItems = $menuRepository->findByName('main');
@endphp

<!DOCTYPE html>
<html lang="de-DE">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>
            {{ title($page, $site) }}
        </title>

        @include('partials.meta')

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="{{ canonical() }}" rel="canonical">
        <link href="{{ asset('/css/styles.css') }}" rel="stylesheet" type="text/css">

        @stack('head')
    </head>
    <body class="{{ viewName($page) }}">

        <header class="site-header">
            <h1 class="site-header__title">
                Super Gear Directus
                <img src="{{ assetsUrl($site['data']['logo']) }}" />
            </h1>
            @include('partials.menu', [ 'menuItems' => $menuItems ])
        </header>

        <main class="site-main">
            @yield('content')
        </main>

        <footer class="site-footer">

        </footer>

        @stack('scripts')
    </body>
</html>
