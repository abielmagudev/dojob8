<span 
    class="{{ $attributes->get('class', 'd-inline-block') }}" 

    data-bs-toggle="tooltip" 
    
    data-bs-title="{{ $title }}"
    
    @if( $attributes->has('placement') )
    data-bs-placement="{{ $attributes->get('placement') }}"
    @endif

    @if( $attributes->has('custom-class') )
    data-bs-custom-class="{{ $attributes->get('custom-class') }}"
    @endif

    @if( $attributes->has('html') )
    data-bs-html="true"
    @endif
>
    {!! $slot !!}
</span>
