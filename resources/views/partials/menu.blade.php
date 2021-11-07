@foreach($menuItems['data'] as $item)
    @php

        // class if url is same as page
        $current = NULL;

        // attribute target
        $target = NULL;

        // if page is not null
        if ($item['page']) {
            $title = $item['page']['title'];
            $url = '/'.$item['page']['slug'];

            // if page is current page
            $current = isCurrentPage($item['page']['slug'], ' current');

            // if title is set overwrite
            if ($item['title']) {
                $title = $item['title'];
            }

        // if page empty and only title and url is set
        } elseif ($item['title'] && $item['url']) {
            $title = $item['title'];
            $url = $item['url'];

            // if target set
            if (isset($item['target'])) {
                $target = 'target='.$item['target'];

                if ($item['target'] === '_blank') {
                    $target .= ' rel=noreferrer';
                }
            }

        } else {
            continue;
        }

    @endphp

    <a class="tabs__item{{ $current }}" {{ $target }} href="{{ $url }}">
        {{ $title }}
    </a>
@endforeach