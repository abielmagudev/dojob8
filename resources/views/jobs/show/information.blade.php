<x-card title="Information">
    <x-slot name="options">
        <a href="{{ route('jobs.edit', $job) }}" class="btn btn-warning">
            <i class="bi bi-pencil-fill"></i>
        </a>
    </x-slot>

    <p>
        <x-badge :color="$job->isAvailable() ? 'success' : 'secondary' " class="text-uppercase">{{ ucfirst($job->available_status) }}</x-badge>
    </p>

    <x-small-label label="Description">
        {{ $job->description }}
    </x-small-label>

    <x-small-label label="Inspections required">
        {{ $job->requireInspections() ? 'Yes' : 'No' }}
    </x-small-label>
    
    <x-custom.small-label-hook-users :model="$job" />
</x-card>
