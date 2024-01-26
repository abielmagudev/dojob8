<x-modal id="updatePaymentsModal" title="Update payment of Work Orders">
    <form action="{{ route('payments.update.many') }}" method="post" autocomplete="off" id="paymentUpdateForm">
        @csrf
        @method('put')
        <div class="mb-3">
            <label for="paymentStatusSelect" class="form-label">Payment</label>
            <select id="paymentStatusSelect" class="form-select" name="payment" required>
                <option disabled selected label="Choose..."></option>
                @foreach($payment_statuses->reverse() as $key => $value)
                <option value="{{ $value }}">{{ ucfirst($key) }}</option>
                @endforeach
            </select>
        </div>
        <br>

        <div class="text-end">
            <x-modal-button-close>Cancel</x-modal-button-close>
            <button class="btn btn-warning" type="submit">Update selected work orders</button>
        </div>
    </form>
</x-modal>
