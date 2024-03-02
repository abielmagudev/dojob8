<?php if(! isset($parameters) ) $parameters = [] ?>
<x-tooltip title="Awaiting inspections">
    <a href="{{ inspectionUrlGenerator('awaiting', $parameters) }}" class="{{ $class ?? 'btn btn-primary btn-sm' }}">
        {{ $counter }}
    </a>
</x-tooltip>
