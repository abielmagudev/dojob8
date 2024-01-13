<div>
    @foreach($contractor->contact_data->filter() as $key => $value)
    <span class="badge border text-start">
        <span class="d-inline-block">{{ ucfirst($key) }}</span>
        <?php $prefix = $key <> 'email' ? 'tel' : 'mailto' ?>
        <a href="{{ $prefix }}:{{ $value }}" class="text-decoration-none">{{ $value }}</a>
    </span>
    <br>
    @endforeach
</div>
