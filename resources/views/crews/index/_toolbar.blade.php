<div class="d-flex justify-content-between align-items-center">
    {{-- Crew shows --}}
    <div>
        <div class="btn-group">
            <a href="{{ route('crews.index', ['show' => 'grid']) }}" class="btn btn-outline-dark {{ $show == 'grid' ? 'active' : '' }}">
                <i class="bi bi-grid"></i>
            </a>
            <a href="{{ route('crews.index', ['show' => 'table']) }}" class="btn btn-outline-dark {{ $show == 'table' ? 'active' : '' }}">
                <i class="bi bi-list-ul"></i>
            </a>
        </div>

        <a href="{{ route('crews.index', array_merge($request->all(), ['active' => $request->get('active', 1) == 1 ? 0 : 1])) }}" class="btn btn-dark" data-bs-toggle="tooltip" data-bs-title="All {{ $request->get('active', 1) == 1 ? 'inactive' : 'active' }}">
            @if( $request->get('active', 1) == 1 )
            <i class="bi bi-dash-circle"></i>
            
            @else
            <i class="bi bi-check-circle"></i>
                
            @endif
        </a>
    </div>

    {{-- Update workers on work orders --}}
    <div class="mx-3">
        <x-modal-trigger modal-id="modalUpdateWorkOrderWorkers" class="btn btn-warning">
            <span>
                <i class="bi bi-people"></i>
            </span>
            <span class="d-none d-md-inline-block">Update work orders</span>
        </x-modal-trigger>
    </div>

    {{-- Create crew --}}
    <div>
        <x-custom.link-with-total total="{{ $crews->count() }}" route="{{ route('crews.create') }}" />
    </div>
</div>
<br>
<br>
