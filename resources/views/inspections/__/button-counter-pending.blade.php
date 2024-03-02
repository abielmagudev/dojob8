<?php if(! isset($parameters) ) $parameters = [] ?>
<x-tooltip title="Pending inspections" class="d-inline-block">
    <a href="{{ inspectionUrlGenerator('pending', $parameters) }}" class="{{ $class ?? 'btn btn-warning btn-sm' }}">
        {{ $counter }}
    </a>
</x-tooltip>
