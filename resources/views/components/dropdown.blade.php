<div class="dropdown">
    <button class="btn {{ $attributes->get('button-class', '') }} {{ $attributes->has('no-caret') ? '' : 'dropdown-toggle' }}" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        {!! $button !!}
    </button>
    <ul class="dropdown-menu border-0 shadow {{ $attributes->get('menu-class', '') }}">
        {!! $slot !!}
    </ul>
</div>
