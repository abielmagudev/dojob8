<?php if(! isset($except) ||! is_array($except) ) $except = [] ?>

@foreach($client->contact_data_collection->filter() as $key => $value)
    @if(! in_array($key, $except) )
    <x-tooltip title="{{ ucfirst($key) }}">
        <span class="badge text-bg-light">
            <?php $prefix = $key <> 'email' ? 'tel' : 'mailto' ?> 
            <a href="{{ $prefix }}:{{ $value }}" class="text-decoration-none">{{ $value }}</a>
        </span>
    </x-tooltip>
    @endif
@endforeach
