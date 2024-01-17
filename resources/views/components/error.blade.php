<div>
    {{-- Has error --}}
    @error( $attributes->get('name') )
    <small class="text-danger">{{ $message }}</small>
    @enderror

    {{-- Has helper input --}}
    @if( $slot->isNotEmpty() &&! $errors->has($attributes->get('name')) )
    <small class="text-secondary">
        @if( $attributes->has('important') )   
        <b class="text-danger">*</b>
        @endif

        {!! $slot !!}
    </small>
    @endif
</div>
