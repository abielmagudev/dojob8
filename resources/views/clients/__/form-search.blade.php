<form action="{{ route('clients.index') }}" method="get" autocomplete="off">
    <div class="input-group">
        <input 
            class="form-control border-end-0 rounded-start-pill bg-transparent text-center {{ $class ?? '' }}" 
            style="{{ $style ?? '' }}"
            id="searchClientInput" 
            type="search" 
            name="search" 
            placeholder="Search client..."
        >
        <button class="btn border border-start-0 rounded-end-pill px-3">
            <i class="bi bi-search"></i>
        </button>
    </div>
</form>
