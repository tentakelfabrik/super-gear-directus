<div class="post__date">
    <time datetime="{{ $post['published_at'] }}">
        {{ Carbon\Carbon::parse($post['published_at'])->diffForHumans() }}
    </time>
</div>
