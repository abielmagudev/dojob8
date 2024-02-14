<x-modal id="modalModifyPaymentStatus" title="Modify payment status of selected work orders" header-close>
    <form action="{{ route('payments.update') }}" method="post" autocomplete="off" id="formUpdatePaymentStatus">
        @method('patch')
        @csrf
        <div class="mb-3">
            <label for="paymentStatusSelect" class="form-label">Payment status</label>
            <select id="paymentStatusSelect" class="form-select" name="payment_status" required>
                @foreach($payment_statuses->reverse() as $status)
                <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </div>
        <input type="hidden" name="url_back" value="{{ $request->fullUrl() }}">
    </form>
    <x-slot name="footer">
        <x-modal-button-close>Cancel</x-modal-button-close>
        <button class="btn btn-warning" type="submit" form="formUpdatePaymentStatus">Update work orders</button>
    </x-slot>
</x-modal>
