<x-tooltip title="All work orders">
    <a href="{{ urlGeneratorWorkOrders('all', $parameters) }}" class="{{ isset($class) ? $class : 'btn btn-primary btn-sm' }}">
        <span class="{{ $counter < 9 ? 'mx-1' : '' }}">{{ $counter }}</span>
    </a>
</x-tooltip>
