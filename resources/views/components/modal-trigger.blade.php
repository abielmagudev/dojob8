@if( $attributes->has('link') )
<a id="{{ $attributes->get('id') }}" class="{{ $attributes->get('class', 'link-primary') }}" data-bs-toggle="modal" data-bs-target="#{{ $attributes->get('modal-id') }}" href="#!">
    {{ $slot }}
</a>

@else
<button id="{{ $attributes->get('id') }}" class="{{ $attributes->get('class', 'btn btn-primary') }}" data-bs-toggle="modal" data-bs-target="#{{ $attributes->get('modal-id') }}" type="button">
    {{ $slot }}
</button>

@endif
