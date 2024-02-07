<div class="d-inline-block">
    @if( $attributes->has('tooltip') )
    <x-tooltip :title="$toggle ? 'Available' : 'Unavailable' ">
        <span class="{{ $toggle ? 'text-success' : 'text-secondary' }}">
            <i class="bi bi-circle-fill"></i>
        </span>
    </x-tooltip>

    @else
    <span class="{{ $toggle ? 'text-success' : 'text-secondary' }}">
        <i class="bi bi-circle-fill"></i>
    </span>
    <span class="text-capitalize">
        {{ $toggle ? 'available' : 'unavailable' }}
    </span>    

    @endif
</div>
