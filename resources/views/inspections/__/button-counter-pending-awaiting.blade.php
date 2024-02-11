<x-tooltip title="Pending and Awaiting inspections" class="d-inline-block">
    <a href="{{ App\Http\Controllers\InspectionController\InspectionUrlGenerator::pendingAndAwaiting($parameters ?? []) }}" class="{{ $class ?? 'btn btn-warning btn-sm' }}">
        {{ $counter }}
    </a>
</x-tooltip>
