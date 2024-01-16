<div>
    @foreach($channels as $key => $value)
    <x-tooltip title="{{ ucfirst($key) }}">
        <span class="badge border">
            <?php $prefix = $key <> 'email' ? 'tel' : 'mailto' ?> 
            <a href="{{ $prefix }}:{{ $value }}" class="text-decoration-none">{!! isset($mark) ? marker($mark, $value) : $value !!}</a>
        </span>
    </x-tooltip>
    @endforeach
</div>
