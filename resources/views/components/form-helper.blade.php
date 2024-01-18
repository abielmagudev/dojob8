<small class="text-secondary">
    @if( $attributes->has('important') )   
    <b class="text-danger">*</b>
    @endif

    {!! $slot !!}
</small>
