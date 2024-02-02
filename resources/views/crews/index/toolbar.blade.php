<div class="row flex-nowrap">
    {{-- Left --}}
    <div class="col text-nowrap">
        <div class="btn-group mx-1">
            <a href="{{ route('crews.index', array_merge($request->all(), ['template' => 'grid'])) }}" class="btn btn-outline-primary {{ bsControlActive( $request->get('template', 'grid') === 'grid' ) }}" data-bs-toggle="tooltip" data-bs-title="Grid">
                <i class="bi bi-grid"></i>
            </a>
            <a href="{{ route('crews.index', array_merge($request->all(), ['template' => 'list'])) }}" class="btn btn-outline-primary {{ bsControlActive( $request->get('template') === 'list' ) }}" data-bs-toggle="tooltip" data-bs-title="List">
                <i class="bi bi-list-ul"></i>
            </a>
        </div>
    </div>

    {{-- Center --}}
    <div class="col text-nowrap text-center">
        <x-modal-trigger modal-id="setWorkOrderWorkersModal" class="btn btn-warning">
            <i class="bi bi-rocket-takeoff"></i>
            <span class="ms-1 d-none d-md-inline-block ">Set on work orders</span>
        </x-modal-trigger>
    </div>

    {{-- Right --}}
    <div class="col text-nowrap text-end">

        <x-tooltip title="Change status crews">
            <x-modal-trigger modal-id="changeStatusCrewsModal" class="btn btn-outline-primary">
                <i class="bi bi-toggles"></i>
            </x-modal-trigger>
        </x-tooltip>

        <a href="{{ route('crews.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i>
        </a>
    </div>
</div>
