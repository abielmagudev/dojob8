<div class="alert alert-dismissible alert-{{ $attributes->get('color', 'none') }} {{ $attributes->get('add-class', '') }}" role="alert">
    <div class="text-center">{!! $slot !!}</div>

    @if( $attributes->has('close') )
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @endif
</div>
