@php
    $content = $post['lead'].$post['content'];
    $readtime = (new \Mtownsend\ReadTime\ReadTime($content))->timeOnly(true)->setTranslation([
            'minute' => ''
        ])->get();
@endphp

<div class="post__readtime">
    Reading time {{ $readtime }} Minutes
</div>