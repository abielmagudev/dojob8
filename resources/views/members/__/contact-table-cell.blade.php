<?php if(! isset($except) ||! is_array($except) ) $except = [] ?>

@foreach($member->contact_data_collection->filter() as $key => $value)
    @if(! in_array($key, $except) )
    <x-tooltip title="{{ ucfirst($key) }}">
        <span class="badge text-bg-light">
            @if( $key <> 'email' )
            <x-link-phone href="{{ $value }}" class="text-decoration-none">{{ $value }}</x-link-phone>
            
            @else
            <x-link-email href="{{ $value }}" class="text-decoration-none">{{ $value }}</x-link-email>
                
            @endif
        </span>
    </x-tooltip>
    @endif
@endforeach
