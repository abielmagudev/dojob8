@if( $attributes->has('link') )
<a {{ $attributes->except(['class', 'modal-id']) }} class="{{ $attributes->get('class', 'link-primary') }}" data-bs-toggle="modal" data-bs-target="#{{ $attributes->get('modal-id') }}" href="#!">
    {{ $slot }}
</a>

@else
<button {{ $attributes->except(['class', 'modal-id']) }} class="{{ $attributes->get('class', 'btn btn-primary') }}" data-bs-toggle="modal" data-bs-target="#{{ $attributes->get('modal-id') }}" type="button">
    {{ $slot }}
</button>

@endif
