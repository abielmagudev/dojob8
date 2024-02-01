@if( $crew->hasDescription() )
<x-tooltip title="{{ $crew->description }}">
    <span class="badge {{ $class ?? '' }} align-middle" style="background-color:{{ $crew->background_color }}; color: {{ $crew->text_color }}">
        {{ $crew->name }}
    </span>
</x-tooltip>
   
@else
<span class="badge {{ $class ?? '' }} align-middle" style="background-color:{{ $crew->background_color }}; color: {{ $crew->text_color }}">
    {{ $crew->name }}
</span>

@endif
