<div>
    {{ $contractor->contact_name }}

    @foreach($contractor->contact_data_collection->filter() as $key => $value)
    <?php $prefix = $key <> 'email' ? 'tel' : 'mailto' ?>
    <x-tooltip title="{{ ucfirst($key) }}">
        <span class="badge text-bg-light">
            <a href="{{ $prefix }}:{{ $value }}" class="text-decoration-none">{{ $value }}</a>
        </span>
    </x-tooltip>
    @endforeach
</div>
