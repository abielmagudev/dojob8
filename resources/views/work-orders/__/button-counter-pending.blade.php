<x-tooltip title="Incomplete work orders">
    <a href="{{ workorderUrlGenerator('pending', ($parameters ?? [])) }}" class="{{ $class ?? 'btn btn-warning btn-sm' }}">
        <span class="{{ $counter < 9 ? 'mx-1' : '' }}">{{ $counter }}</span>
    </a>    
</x-tooltip>
