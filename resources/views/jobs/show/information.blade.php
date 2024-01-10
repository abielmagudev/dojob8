<x-card title="Information">
    <x-slot name="options">
        <a href="{{ route('jobs.edit', $job) }}" class="btn btn-warning">
            <i class="bi bi-pencil-fill"></i>
        </a>
    </x-slot>

    <p>
        <x-indicator-on-off :toggle="$job->isAvailable()" />
        <span>{{ ucfirst($job->available_text) }}</span>
    </p>

    <x-small-title title="Description">
        {{ $job->description }}
    </x-small-title>

    <x-small-title title="Inspections required">
        {{ $job->requireInspections() ? 'Yes' : 'No' }}
    </x-small-title>
    
    <x-custom.content-hook-users :model="$job" />
</x-card>
