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
    </div>

    {{--  --}}
    <div>

    </div>

    {{-- Create crew --}}
    <div>
        <a href="{{ route('crews.index', array_merge($request->all(), ['active' => $request->get('active', 1) == 1 ? 0 : 1])) }}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-title="All {{ $request->get('active', 1) == 1 ? 'inactive' : 'active' }}">
            @if( $request->get('active', 1) == 1 )
            <i class="bi bi-dash-circle"></i>
            
            @else
            <i class="bi bi-check-circle"></i>
                
            @endif
        </a>

        <div class="btn-group">
            <span class="btn btn-primary active" data-bs-toggle="tooltip" data-bs-title="Total">{{ $crews->count() }}</span>
            <a href="{{ route('crews.create') }}" class="btn btn-primary">
                <b>+</b>
            </a>
        </div>
    </div>
</div>
<br>
<br>
