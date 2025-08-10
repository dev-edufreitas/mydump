@props(['href' => null, 'icon', 'title', 'danger' => false])

@if($href)
    <a href="{{ $href }}"
       class="action-button {{ $danger ? 'danger' : '' }}"
       title="{{ $title }}" 
       aria-label="{{ $title }}">
        {!! $icon !!}
    </a>
@else
    <button type="submit"
            class="action-button {{ $danger ? 'danger' : '' }}"
            title="{{ $title }}" 
            aria-label="{{ $title }}">
        {!! $icon !!}
    </button>
@endif
