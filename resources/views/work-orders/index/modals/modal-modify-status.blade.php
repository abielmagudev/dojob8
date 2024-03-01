<!-- Trigger -->
<x-modal-trigger modal-id="modalModifyStatus" class="dropdown-item">
    <i class="bi bi-pencil-square"></i>
    <span class="ms-1">Modify status</span>
</x-modal-trigger>

<!-- Modal -->
@push('end')
<x-modal id="modalModifyStatus" title="Modify status of selected work orders" header-close>
    <form action="{{ route('work-orders.update.status') }}" method="post" id="formUpdateStatus">
        @method('patch')
        @csrf
        <div>
            <label for="statusSelect" class="form-label">Status</label>
            <select id="statusSelect" class="form-select" name="status">
                @foreach($all_statuses as $status)
                <option value="{{ $status }}">{{ strtoupper($status) }}</option>
                @endforeach
            </select>
        </div>
        <input type="hidden" name="url_back" value="{{ $request->fullUrl() }}">
    </form>
    <x-slot name="footer">
        <x-modal-button-close>Cancel</x-modal-button-close>
        <button class="btn btn-warning" type="sumit" form="formUpdateStatus">Update work orders</button>
    </x-slot>
</x-modal>
@endpush
