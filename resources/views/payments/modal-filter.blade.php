<x-modal id="filterPaymentsModal" title="Payment filters">
    <form action="{{ route('payments.index') }}" method="get" autocomplete="off" >
        @csrf
        @include('components.custom.input-between-dates')
        @include('payments.modal-filters.status')
        @include('work-orders.index.modal-filters.contractor')
        @include('work-orders.index.modal-filters.job')
        <br>

        <div class="text-end">
            <x-modal-button-close>Cancel</x-modal-button-close>
            <button class="btn btn-success" type="submit">Set filters on Payments</button>
        </div>
    </form>
</x-modal>
