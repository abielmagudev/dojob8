@if( $attributes->has('link') )
<a {{ $attributes->except(['class', 'modal-id', 'link']) }} class="{{ $attributes->get('class', 'link-primary') }}" data-bs-target="#{{ $attributes->get('modal-id') }}" data-bs-toggle="modal" href="#!">
    {{ $slot }}
</a>

@else
<button {{ $attributes->except(['class', 'modal-id']) }} class="{{ $attributes->get('class', 'btn btn-primary') }}" data-bs-target="#{{ $attributes->get('modal-id') }}" data-bs-toggle="modal" type="button">
    {{ $slot }}
</button>

@endif
