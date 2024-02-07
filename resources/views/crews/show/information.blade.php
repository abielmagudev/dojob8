<x-card title="Information">
    <x-slot name="custom_title">
        <x-custom.indicator-active-status :toggle="$crew->isActive()" />
    </x-slot>

    <x-slot name="options">
        <a href="{{ route('crews.edit', $crew) }}" class="btn btn-warning">
            <i class="bi bi-pencil-fill"></i>
        </a>
    </x-slot>

    <p>
        <span class="badge" style="background-color:{{ $crew->background_color }};color:{{ $crew->text_color }}">Background & text color</span>
    </p>

    <x-small-title title="Description">
        {{ $crew->description }}
    </x-small-title>

    <x-custom.information-hook-users :model="$crew" />
</x-card>
