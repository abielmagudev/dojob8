<div>
    @foreach($contractor->contact_data->filter() as $key => $value)
    <?php $prefix = $key <> 'email' ? 'tel' : 'mailto' ?>
    <x-tooltip title="{{ ucfirst($key) }}">
        <span class="badge border">
            <a href="{{ $prefix }}:{{ $value }}" class="text-decoration-none">{{ $value }}</a>
        </span>
    </x-tooltip>
    @endforeach
</div>
