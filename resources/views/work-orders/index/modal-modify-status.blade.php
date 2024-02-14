<x-modal id="modalModifyStatusWorkOrders" title="Modify status of selected work orders" header-close>
    <form action="{{ route('work-orders.update.status') }}" method="post" id="formUpdateStatusWorkOrders">
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
        <button class="btn btn-warning" type="sumit" form="formUpdateStatusWorkOrders">Update work orders</button>
    </x-slot>
</x-modal>
