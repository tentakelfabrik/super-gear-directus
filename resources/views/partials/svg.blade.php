<svg class="icon @if (isset($classes)) {{ implode(' ', $classes) }} @endif" aria-hidden="true" @if (isset($alt)) alt="{{ $alt }}"  @endif >
    <use xlink:href="/symbol-defs.svg#icon-{{ $icon }}"></use>
</svg>