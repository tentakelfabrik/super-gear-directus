@extends('layout')

{{-- pretend duplicate content --}}
@push('head')
    <meta name="robots" content="noindex,follow" />
@endpush

{{-- inject helper for content & repositories --}}
@inject('markdownHelper', 'App\Helpers\MarkdownHelper')
@inject('postRepository', 'App\Repositories\PostRepository')

@php
    $posts = $postRepository->find();
@endphp

@section('content')

<h1>
    {{ $page['data']['title'] }}
</h1>
<div class="content">
    {!! $markdownHelper->parse($page['data']['content']) !!}
</div>

@if (count($posts) > 0)
    @foreach($posts['data'] as $post)
        <a class="post" href="/blog/{{ $post['slug'] }}">
            <header class="post__header">
                <h2 class="post__title">
                    {{ $post['title'] }}
                </h2>
                @include('partials.date', ['post' => $post])
                @include('partials.readtime', ['post' => $post])
                @if (isset($post['media_teaser']['id']))
                    <div class="post__teaser">
                        <img src="{{ assetsUrl($post['media_teaser']['id']) }}" alt="{{ $post['media_teaser']['description'] }}" />
                    </div>
                @endif
            </header>
            <div class="content post__lead">
                {!! $markdownHelper->parse($post['lead']) !!}
            </div>
        </div>
    @endforeach
@else
    <div class="post">
        <p>
            Nothing!
        </p>
    </div>
@endif

@endsection
