@foreach($client->contact_data_collection->filter() as $key => $value)
    <x-tooltip title="{{ ucfirst($key) }}">
        <span class="badge text-bg-light">
            <?php $prefix = $key <> 'email' ? 'tel' : 'mailto' ?> 
            <a href="{{ $prefix }}:{{ $value }}">{{ $value }}</a>
        </span>
    </x-tooltip>
@endforeach
