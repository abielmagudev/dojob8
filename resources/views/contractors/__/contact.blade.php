<?php if(! isset($except) ||! is_array($except) ) $except = [] ?>

<div>
    @if(! in_array('contact_name', $except) )
    <span>{{ $contractor->contact_name }}</span><br>
    @endif

    @if(! in_array('name_alias', $except) )
    <span>{{ $contractor->name }} ({{ $contractor->alias }})</span><br>
    @endif

    @foreach($contractor->contact_data_collection->filter() as $key => $value)
    @if(! in_array($key, $except) )
    <span class="badge text-bg-light text-start">
        <span class="d-inline-block " style="width:48px">{{ ucfirst($key) }}</span>
        @if( $key <> 'email' )
        <x-link-phone href="{{ $value }}" class="text-decoration-none">{{ $value }}</x-link-phone>
        
        @else
        <x-link-email href="{{ $value }}" class="text-decoration-none">{{ $value }}</x-link-email>
            
        @endif
    </span>
    <br>
    @endif
    @endforeach
</div>
