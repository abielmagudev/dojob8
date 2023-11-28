<x-card title="Information">
    <x-slot name="options">
        <a href="{{ route('crews.edit', $crew) }}" class="btn btn-warning">
            <i class="bi bi-pencil-fill"></i>
        </a>
    </x-slot>

    <p>
        <x-badge :color="$crew->isActive() ? 'success' : 'secondary'" class="text-uppercase">{{ $crew->active_status }}</x-badge>
        <span class="align-middle" style="color: {{ $crew->color }}">
            <i class="bi bi-circle-fill"></i>
        </span>
    </p>

    <x-small-label label="Name">
        {{ $crew->name }}
    </x-small-label>

    <x-small-label label="Description">
        {{ $crew->description }}
    </x-small-label>

    <x-custom.small-label-hook-users :model="$crew" />
</x-card>
