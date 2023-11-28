<div class="{{ $attributes->get('class', 'mb-3') }}">
    @if(! $attributes->has('label-bottom') )
    <small class="d-block {{ $attributes->get('label-class', 'text-secondary') }}">{{ $label }}</small>
    @endif
    
    <div class="{{ $attributes->get('content-class', '') }}">{!! $slot !!}</div>
    
    @if( $attributes->has('label-bottom') )
    <small class="d-block {{ $attributes->get('label-class', 'text-secondary') }}">{{ $label }}</small>
    @endif
</div>
