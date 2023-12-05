<?php if(! isset($except) ||! is_array($except) ) $except = [] ?>
<?php $icon_class = [
    'phone' => 'bi bi-telephone',
    'mobile' => 'bi bi-phone',
    'email' => 'bi bi-envelope',
] ?>
<div>
    @if(! in_array('contact_name', $except) )
    <span>{{ $contractor->contact_name }}</span><br>
    @endif

    @if(! in_array('name_alias', $except) )
    <span>{{ $contractor->name }} ({{ $contractor->alias }})</span><br>
    @endif

    @foreach($contractor->contact_data_collection->filter() as $key => $value)
    @if(! in_array($key, $except) )
    <?php $prefix = $key <> 'email' ? 'tel' : 'mailto' ?>
    <span class="badge text-bg-light text-start">
        <span class="d-inline-block " style="width:48px">{{ ucfirst($key) }}</span>
        <a href="{{ $prefix }}:{{ $value }}" class="text-decoration-none">{{ $value }}</a>
    </span>
    <br>
    @endif
    @endforeach
</div>
