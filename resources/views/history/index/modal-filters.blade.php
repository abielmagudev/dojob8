<x-modal id="historyFilterModal" title="History filters" footer-close>

    <form action="{{ route('history.index') }}" method="get" autocomplete="off" id="formFilterHistory">
        <div class="mb-3">
            <div class="row g-0">
                <div class="col-sm me-md-3">
                    <label for="fromDateInput" class="form-label">From</label>
                    <input id="fromDateInput" class="form-control mb-3 mb-md-0" type="date" name="between[from]" value="{{ $request->input('between.from') }}">
                </div>
                <div class="col-sm">
                    <label for="toDateInput" class="form-label">To</label>
                    <input id="toDateInput" class="form-control" type="date" name="between[to]" value="{{ $request->input('between.to') }}">
                </div>
            </div>
            <small class="d-block text-secondary mt-1">For any date, leave both or specific field empty.</small>
        </div>
        <div class="mb-3">
            <label for="topicSelect" class="form-label">Topic</label>
            <select id="topicSelect" class="form-select" name="topic">
                <option selected label="- Any topic -"></option>

                @foreach($topics as $topic)
                <option value="{{ $topic }}" {{ isSelected($topic == $request->get('topic')) }}>{{ ucfirst($topic) }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="userSelect" class="form-label">User</label>
            <select id="userSelect" class="form-select" name="user">
                <option selected label="- Any user -"></option>
                
                @foreach($users as $user)
                <option value="{{ $user->id }}" {{ isSelected($user->id == $request->get('user')) }}>{{ ucfirst($user->name) }} {{ $user->deleted_at ? '(Deleted)' : '' }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="sortSelect" class="form-label">Sort</label>
            <select id="sortSelect" class="form-select" name="sort">
                <option value="desc" {{ isSelected('desc' == $request->get('sort')) }}>Newest to oldest</option>
                <option value="asc" {{ isSelected('asc' == $request->get('sort')) }}>Oldest to newest</option>
            </select>
        </div>
    </form>
    
    <x-slot name="footer">
        <button class="btn btn-success" type="submit" form="formFilterHistory">Filter</button>
    </x-slot>
</x-modal>
