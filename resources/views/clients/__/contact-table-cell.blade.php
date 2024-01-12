@foreach($client->contact_data_collection->filter() as $key => $value)
    <x-tooltip title="{{ ucfirst($key) }}">
        <span class="badge">
            <?php $prefix = $key <> 'email' ? 'tel' : 'mailto' ?> 
            <a href="{{ $prefix }}:{{ $value }}" class="text-decoration-none">{!! isset($mark) ? marker($mark, $value) : $value !!}</a>
        </span>
    </x-tooltip>
@endforeach
