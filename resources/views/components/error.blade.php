<div class="small ms-1 {{ $attributes->get('class', '') }}">
    @error( $attributes->get('name') )
    <span class="text-danger">{{ $message }}</span>
    
    @else
        @if( $slot->isNotEmpty() )

        @if( $attributes->has('important') )   
        <b class="text-danger">*</b>
        @endif

        <span class="text-secondary">
            {!! $slot !!}
        </span>

        @endif
    
    @enderror
</div>
