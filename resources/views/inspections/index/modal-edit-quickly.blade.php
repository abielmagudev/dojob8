<x-modal-trigger modal-id="modalEditQuickly" class="dropdown-item">
    <i class="bi bi-pencil-square"></i>
    <span class="ms-1">Edit quickly</span>
</x-modal-trigger>

@push('end')
<x-modal id="modalEditQuickly" title="Edit selected inspections" header-close>
    <form action="{{ route('inspections.update.status') }}" method="post" id="formUpdateStatus">
        @method('patch')
        @csrf
        <div class="mb-3">
            <label for="statusSelect" class="form-label">Status</label>
            <select id="statusSelect" class="form-select" name="status" required>
                @foreach($all_statuses as $status)
                <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </div>
        <input type="hidden" name="url_back" value="{{ $request->fullUrl() }}">
    </form>

    @slot('footer')
    <x-modal-button-close>Close</x-modal-button-close>
    <button class="btn btn-warning" type="submit" form="formUpdateStatus">Update selected inspections</button>
    @endslot
</x-modal>
@endpush
