<form action="{{ route('app.search') }}" method="get" autocomplete="off">
    <div class="input-group flex-nowrap">

        <input 
            type="search" 
            name="value" 
            placeholder="Search"
            value="{{ request()->get('search', '') }}"
            class="border-end-0 rounded-start-pill form-control bg-transparent ps-3" 
            required
        >

        <select name="topic" class="form-select bg-transparent flex-shrink-1 pe-0">
            <option value="client" {{ isSelected( request()->get('topic', 'client') == 'client' ) }}>Client</option>
            <option value="work-order" {{ isSelected( request()->get('topic') == 'work-order' ) }}>Work Order</option>
        </select>

        <button class="btn border border-start-0 rounded-end-pill px-3">
            <i class="bi bi-search"></i>
        </button>
        
    </div>
</form>
