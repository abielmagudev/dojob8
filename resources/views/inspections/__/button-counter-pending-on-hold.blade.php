<x-tooltip title="Pending and On hold inspections">
    <a href="{{ urlGeneratorInspection('pendingAndOnHold', $parameters ?? []) }}" class="{{ $class ?? 'btn btn-warning btn-sm' }}">
        {{ $counter }}
    </a>
</x-tooltip>
