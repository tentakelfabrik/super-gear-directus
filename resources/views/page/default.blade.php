@extends('layout')

@inject('markdownHelper', 'App\Helpers\MarkdownHelper')
@inject('snippetRepository', 'App\Repositories\SnippetRepository')

@section('content')

<h1>
    {{ $page['data']['title'] }}
</h1>
<div class="content">
    {!! $markdownHelper->parse($page['data']['content']) !!}
</div>

@foreach($snippetRepository->findByName('default')['data'] as $snippet)
    <div class="snippet">
        <h3>
            {{ $snippet['title'] }}
        </h3>
        <div class="snippet__media">
            <img src="{{ assetsUrl($snippet['file']['id']) }}" alt="{{ $snippet['file']['description'] }}" />
        </div>
        <div class="snippet__content content">
            {!! $markdownHelper->parse($snippet['content']) !!}
        </div>
    </div>
@endforeach

@endsection
