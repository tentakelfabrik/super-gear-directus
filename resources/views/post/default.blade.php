@extends('layout')

@inject('markdownHelper', 'App\Helpers\MarkdownHelper')

@section('content')

<h1>
    {{ $page['data']['title'] }}
</h1>
<div class="content content--lead">
    {!! $markdownHelper->parse($page['data']['lead']) !!}
</div>
<div class="content">
    {!! $markdownHelper->parse($page['data']['content']) !!}
</div>

@endsection
