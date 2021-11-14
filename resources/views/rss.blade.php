@inject('markdownHelper', 'App\Helpers\MarkdownHelper')

@php
if (isset($_SERVER['HTTPS'])) {
    $http = 'https';
} else {
    $http = 'http';
}

$base_url = $http.'://'.$_SERVER['SERVER_NAME'];

@endphp

<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <title>{{ $site['data']['title'] }}</title>
	    <atom:link href="{{ $base_url }}/feed" rel="self" type="application/rss+xml" />
	    <link>{{ $base_url }}/blog</link>
	    <description>{{ $site['data']['description'] }}</description>
	    <lastBuildDate>{{ date(DATE_RSS) }}</lastBuildDate>
	    <language>{{ $_ENV['APP_LOCALE'] }}-{{ strtoupper($_ENV['APP_LOCALE']) }}</language>
        @foreach($posts['data'] as $post)
            <item>
                <title>{{ $post['title'] }}</title>
                <link>{{ $base_url.'/blog/'.$post['slug'] }}</link>
                <pubDate>{{ date(DATE_RSS, strtotime($post['published_at'])) }}</pubDate>
                <description>
                    <![CDATA[
                        {!! $markdownHelper->parse($post['lead']) !!}
                        {!! $markdownHelper->parse($post['content']) !!}
                    ]]>
                </description>
                <guid isPermaLink="false">{{ $post['slug'] }}</guid>
            </item>
        @endforeach
    </channel>
</rss>
