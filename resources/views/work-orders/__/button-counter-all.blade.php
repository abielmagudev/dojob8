<x-tooltip title="All work orders">
    <a href="{{ workorderUrlGenerator('all', $parameters ?? []) }}" class="{{ $class ?? 'btn btn-primary btn-sm' }}">
        <span class="{{ $counter < 9 ? 'mx-1' : '' }}">{{ $counter }}</span>
    </a>
</x-tooltip>
