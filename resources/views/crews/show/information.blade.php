<x-card title="Information">
    <x-slot name="options">
        <a href="{{ route('crews.edit', $crew) }}" class="btn btn-warning">
            <i class="bi bi-pencil-fill"></i>
        </a>
    </x-slot>

    <p>
        <x-badge :color="$crew->isActive() ? 'success' : 'secondary'" class="text-uppercase">{{ $crew->active_status }}</x-badge>

        <span class="badge text-uppercase " style="background-color:{{ $crew->background_color }}; color: {{ $crew->text_color }}">
            {{ $crew->text_color_mode }}
        </span>
    </p>

    @if( $crew->hasDescription() )        
    <x-small-label label="Description">
        {{ $crew->description }}
    </x-small-label>
    @endif

    <x-custom.small-label-hook-users :model="$crew" />
</x-card>
