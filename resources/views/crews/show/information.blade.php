<x-card title="Information">
    <x-slot name="options">
        <a href="{{ route('crews.edit', $crew) }}" class="btn btn-warning">
            <i class="bi bi-pencil-fill"></i>
        </a>
    </x-slot>

    <p>
        <x-indicator-on-off :toggle="$crew->isActive()" />
        <span class="text-capitalize">{{ $crew->active_status }}</span>
    </p>

    <p>
        <span class="badge" style="background-color:{{ $crew->background_color }};color:{{ $crew->text_color }}">Background & text color</span>
    </p>

    <x-small-title title="Description">
        {{ $crew->description }}
    </x-small-title>

    <x-custom.information-hook-users :model="$crew" />
</x-card>
