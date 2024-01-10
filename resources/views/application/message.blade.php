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
    <div class="alert alert-dismissible alert-{{ $status }}" role="alert">
        <div class="text-center">{!! session()->get($status) !!}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
@endforeach
