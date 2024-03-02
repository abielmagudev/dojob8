<?php if(! isset($parameters) ) $parameters = [] ?>
<x-tooltip title="Pending and Awaiting inspections">
    <a href="{{ inspectionUrlGenerator('pendingAndAwaiting', $parameters) }}" class="{{ $class ?? 'btn btn-warning btn-sm' }}">
        {{ $counter }}
    </a>
</x-tooltip>
