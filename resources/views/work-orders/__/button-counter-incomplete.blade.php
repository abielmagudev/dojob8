<x-tooltip title="Incomplete work orders">
    <a href="{{ App\Http\Controllers\WorkOrderController\WorkOrderUrlGenerator::incomplete($parameters ?? []) }}" class="{{ $class ?? 'btn btn-warning btn-sm' }}">
        <span class="{{ $counter < 9 ? 'mx-1' : '' }}">{{ $counter }}</span>
    </a>    
</x-tooltip>
