<x-modal id="modalEditQuicklyPayments" title="Edit selected payments" header-close>
    <form action="{{ route('payments.update') }}" method="post" autocomplete="off" id="formEditQuicklyPayments">
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
    <x-slot name="footer">
        <x-modal-button-close>Cancel</x-modal-button-close>
        <button class="btn btn-warning" type="submit" form="formEditQuicklyPayments">Update selected payments</button>
    </x-slot>
</x-modal>
