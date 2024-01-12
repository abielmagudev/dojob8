<div>
    @foreach($client->contact_data->filter() as $key => $value)
    <p class="mb-1">
        <span class="badge border text-start">
            <span class="d-inline-block">{{ ucfirst($key) }}</span>
            <?php $prefix = $key <> 'email' ? 'tel' : 'mailto' ?>
            <a href="{{ $prefix }}:{{ $value }}" class="text-decoration-none">{{ $value }}</a>
        </span>
    </p>
    @endforeach
</div>
