<div>
    {{-- Has error input --}}
    @error( $attributes->get('error') )
    <small class="text-danger">{{ $message }}</small>
    @enderror

    {{-- Has helper input --}}
    @if( $slot->isNotEmpty() &&! $errors->has($attributes->get('error')) )

        @if( $attributes->has('important') )
        <x-form-helper important>
            {!! $slot !!}
        </x-form-helper>

        @else
        <x-form-helper>
            {!! $slot !!}
        </x-form-helper>

        @endif
    @endif
</div>
