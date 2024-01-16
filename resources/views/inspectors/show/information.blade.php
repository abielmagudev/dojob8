<x-card title="Information" class="h-100">
    <x-slot name="options">
        <a href="{{ route('inspectors.edit', $inspector) }}" class="btn btn-warning">
            <i class="bi bi-pencil-fill"></i>
        </a>
    </x-slot>

    <x-small-title title="Notes">
        {{ $inspector->notes }}
    </x-small-title>

    <x-custom.information-hook-users :model="$inspector" />
</x-card>
