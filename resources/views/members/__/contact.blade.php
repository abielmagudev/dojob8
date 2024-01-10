<?php if(! isset($except) ||! is_array($except) ) $except = [] ?>

@foreach($member->contact_data_collection->filter() as $key => $value)
    <span class="badge text-bg-light text-start">
        <span class="d-inline-block " style="width:48px">{{ ucfirst($key) }}</span>
        <?php $prefix = $key <> 'email' ? 'tel' : 'mailto' ?>
        <a href="{{ $prefix }}:{{ $value }}" class="text-decoration-none">{{ $value }}</a>    
    </span>
    <br>
@endforeach
