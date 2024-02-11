<x-tooltip title="All work orders" class="d-inline-block ">
    <a href="{{ App\Http\Controllers\WorkOrderController\WorkOrderUrlGenerator::all($parameters ?? []) }}" class="{{ $class ?? 'btn btn-primary btn-sm' }}">
        <span class="{{ $counter < 9 ? 'mx-1' : '' }}">{{ $counter }}</span>
    </a>
</x-tooltip>
