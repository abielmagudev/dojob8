<?php $colors = [
    'danger',
    'dark',
    'info',
    'light',
    'primary',
    'secondary',
    'success',
    'warning',
] ?>

@foreach($colors as $status)
    @if( session()->has($status) )
    <x-alert color="{{ $status }}" close>
        <span>{!! session()->get($status) !!}</span>
    </x-alert>
    @endif
@endforeach
