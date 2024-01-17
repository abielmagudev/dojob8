<div>
    @foreach($client->contact_data->filter() as $channel => $value)
    <x-tooltip title="{{ $channel }}">
        <?php $prefix = $channel <> 'email' ? 'tel' : 'mailto' ?>
        <span class="badge border">
            <a href="{{ $prefix }}:{{ $value }}" class="text-decoration-none">
                {!! isset($mark) ? marker($mark, $value) : $value !!}
            </a>
        </span>
    </x-tooltip>
    @endforeach
</div>
