@inject('pageRepository', 'App\Repositories\PageRepository')
@inject('markdownHelper', 'App\Helpers\MarkdownHelper')

<!DOCTYPE html>
<html lang="de-DE" class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>
            Elina Penner | {{ $page['data']['title'] }}
        </title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ (isset($_SERVER['HTTPS']) ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] }}" rel="canonical">
        <link href="{{ asset('/css/index.css') }}" rel="stylesheet" type="text/css">

        @stack('head')
    </head>
    <body class="{{ viewName($page) }}">

        <header class="site-header">
            <h1 class="site-header__title">
                Super Gear Directus
            </h1>
        </header>

        <main class="site-main">
            @yield('content')
        </main>

        <footer class="site-footer">

        </footer>

        @stack('scripts')
    </body>
</html>
