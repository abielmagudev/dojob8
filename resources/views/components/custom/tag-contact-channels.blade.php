@foreach($attributes->get('channels') as $channel => $value)
<?php $prefix = $channel <> 'email' ? 'tel' : 'mailto' ?>
<x-tag-addon addon="{{ ucfirst($channel) }}" bordered rounded>
    <a href="{{ $prefix }}:{{ $value }}" class="text-decoration-none">{{ $value }}</a>
</x-tag-addon>
<br>
@endforeach
