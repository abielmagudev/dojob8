<form action="{{ route('app.search') }}" method="get" autocomplete="off">
    <div class="d-flex align-items-center justify-content-between">

        <div class="me-2">
            <div class="input-group">
                <input 
                    type="search" 
                    name="value" 
                    placeholder="Search"
                    value="{{ request()->get('search', '') }}"
                    class="form-control bg-transparent border-end-0 rounded-start-pill ps-3" 
                    required
                >
                <button class="btn border border-start-0 rounded-end-pill px-3">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>

        <div>
            <select name="topic" class="form-select bg-transparent rounded-pill">
                <option value="client" {{ isSelected( request()->get('topic', 'client') == 'client' ) }}>Client</option>
                <option value="work-order" {{ isSelected( request()->get('topic') == 'work-order' ) }}>Work Order</option>
            </select>
        </div>
        
    </div>
</form>
