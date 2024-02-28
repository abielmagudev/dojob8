<form action="{{ route('work-orders.update.ordered') }}" method="post" id="formWorkOrderOrdered">
    @method('patch')
    @csrf
    <input type="hidden" name="url_back" value="{{ $request->fullUrl() }}">
    <button class="dropdown-item">
        <i class="bi bi-floppy"></i>
        <span class="ms-1">Update order</span>
    </button>
</form>
