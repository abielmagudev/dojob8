
<div>
    <span>{{ $contractor->contact_name }}</span><br>
    <span>{{ $contractor->name }} ({{ $contractor->alias }})</span><br>

    @foreach($contractor->contact_data_collection->filter() as $key => $value)
    <span class="badge text-bg-light text-start">
        <span class="d-inline-block " style="width:48px">{{ ucfirst($key) }}</span>
        <?php $prefix = $key <> 'email' ? 'tel' : 'mailto' ?>
        <a href="{{ $prefix }}:{{ $value }}" class="text-decoration-none">{{ $value }}</a>
    </span>
    <br>
    @endforeach
</div>
