<form action="{{ route('work-orders.update.quickly', 'ordering') }}" method="post" id="workOrderOrderingUpdateForm">
    @method('patch')
    @csrf
    <button class="dropdown-item" type="submit">
        <i class="bi bi-floppy"></i>
        <span class="ms-1">Save Ordering</span>
    </button>
    <input type="hidden" name="url_back" value="{{ $request->fullUrl() }}">
</form>
