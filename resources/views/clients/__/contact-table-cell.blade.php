<?php if(! isset($except) ||! is_array($except) ) $except = [] ?>

@if(! in_array('full_name', $except) )
<span class="badge text-bg-light">{{ $client->full_name }}</span>
@endif

@foreach($client->contact_data_collection->filter() as $key => $value)
    @if(! in_array($key, $except) )
    <x-tooltip title="{{ ucfirst($key) }}">
        <span class="badge text-bg-light">
            <?php $prefix = $key <> 'email' ? 'tel' : 'mailto' ?> 
            <a href="{{ $prefix }}:{{ $value }}">{{ $value }}</a>
        </span>
    </x-tooltip>
    @endif
@endforeach
