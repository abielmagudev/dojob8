<x-tooltip title="Pending inspections">
    <a href="{{ urlGeneratorInspection('pending', $parameters ?? []) }}" class="{{ $class ?? 'btn btn-warning btn-sm' }}">
        {{ $counter }}
    </a>
</x-tooltip>
