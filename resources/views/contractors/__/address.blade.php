<?php if(! isset($except) ||! is_array($except) ) $except = [] ?>
<address>
    @if(! in_array('name_alias', $except) )
    <span>{{ $contractor->name }} ({{ $contractor->alias }})</span><br>
    @endif

    @if(! in_array('street', $except) )
    <span>{{ $contractor->street }}</span><br>
    @endif

    @if(! in_array('location', $except) )
    <span>{{ $contractor->location_without_country->implode(', ') }}</span> 
    @endif

    @if(! in_array('zip_code', $except) )
    <span>{{ $contractor->zip_code }}</span><br>
    @endif

    @if(! in_array('country', $except) )
    <span>{{ $contractor->country_name }}</span><br>
    @endif
</address>
