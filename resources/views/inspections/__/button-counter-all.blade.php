<?php if(! isset($parameters) ) $parameters = [] ?>
<x-tooltip title="All inspections">
    <a href="{{ inspectionUrlGenerator('all', $parameters) }}" class="{{ $class ?? 'btn btn-primary btn-sm' }}">
        {{ $counter }}
    </a>
</x-tooltip>
