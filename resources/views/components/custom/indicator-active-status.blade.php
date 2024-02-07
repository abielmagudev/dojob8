<div class="d-inline-block">
    @if( $attributes->has('tooltip') )
    <x-tooltip :title="$toggle ? 'Active' : 'Inactive' ">
        <span class="{{ $toggle ? 'text-success' : 'text-secondary' }}">
            <i class="bi bi-circle-fill"></i>
        </span>
    </x-tooltip>

    @else
    <span class="{{ $toggle ? 'text-success' : 'text-secondary' }}">
        <i class="bi bi-circle-fill"></i>
    </span>
    <span class="text-capitalize">
        {{ $toggle ? 'active' : 'inactive' }}
    </span>    

    @endif
</div>
