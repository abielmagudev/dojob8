@if(! $attributes->has('background-color') )
<span class="badge text-bg-{{ $attributes->get('color', 'light') }} {{ $attributes->get('class', '') }}">
    {!! $slot !!}
</span>

@else
<span class="badge {{ $attributes->get('class', '') }} {{ $attributes->get('text-color', 'white') }}" @if( $attributes->has('background-color')) style="background-color: {{ $attributes->get('background-color') }}" @endif>
    {!! $slot !!}
</span>

@endif
