<div class="dropdown {{ $attributes->get('class', '') }}">
    <button class="{{ $attributes->get('button-class', 'btn') }} {{ ! $attributes->has('no-caret') ? 'dropdown-toggle' : '' }}" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        {!! $button !!}
    </button>
    <ul class="dropdown-menu shadow border-0 {{ $attributes->get('menu-class', '') }}">
        {{-- 
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item active" href="#">Action</a></li>
            <li><button class="dropdown-item" type="button">Action</button></li>
            <li><h6 class="dropdown-header">Dropdown header</h6></li>
            <li><span class="dropdown-item-text">Dropdown item text</span></li>
            <li><hr class="dropdown-divider"></li>    
        --}}
        {!! $slot !!}
    </ul>
</div>
