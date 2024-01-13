@foreach($attributes->get('channels') as $channel => $value)
<?php $prefix = $channel <> 'email' ? 'tel' : 'mailto' ?>
<p class="mb-1">
    <span class="text-capitalize">{{ $channel }}</span>
    <a href="{{ $prefix }}:{{ $value }}" class="text-decoration-none">{{ $value }}</a>
</p>
@endforeach
