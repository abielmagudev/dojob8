<x-tooltip title="Incomplete work orders" class="d-inline-block">
    <a href="{{ App\Http\Controllers\WorkOrderController\WorkOrderUrlGenerator::incomplete($parameters) }}" class="{{ isset($class) ? $class : 'btn btn-warning btn-sm' }}">
        <span class="{{ $counter < 9 ? 'mx-1' : '' }}">{{ $counter }}</span>
    </a>    
</x-tooltip>