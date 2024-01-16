<x-card title="Information">
    <x-slot name="options">
        <a href="{{ route('crews.edit', $crew) }}" class="btn btn-warning">
            <i class="bi bi-pencil-fill"></i>
        </a>
    </x-slot>

    <p>
        <x-indicator-on-off :toggle="$crew->isActive()" />
        <span class="text-uppercase">{{ $crew->active_status }}</span>

        <span class="badge text-uppercase " style="background-color:{{ $crew->background_color }}; color: {{ $crew->text_color }}">
            {{ $crew->text_color_mode }}
        </span>
    </p>

    <p>
        {{ $crew->description }}
    </p>

    <x-custom.information-hook-users :model="$crew" />
</x-card>
