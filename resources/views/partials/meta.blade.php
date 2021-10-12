@if (isset($page['data']['meta']))
    @foreach($page['data']['meta'] as $meta)
        <meta name="{{ $meta['name'] }}" content="{{ $meta['content'] }}" />
    @endforeach
@endif