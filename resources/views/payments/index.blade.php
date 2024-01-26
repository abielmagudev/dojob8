@extends('application')

@section('header')
<x-page-title>Payments</x-page-title>
@endsection

@section('content')
<x-card title="{{ $work_orders->count() }} Work Orders">
    
    @slot('options')
    <x-modal-trigger modal-id="filterPaymentsModal">
        <i class="bi bi-funnel"></i>
    </x-modal-trigger>

    <x-modal-trigger modal-id="updatePaymentsModal" class="btn btn-warning">
        <i class="bi bi-arrow-clockwise"></i>
    </x-modal-trigger>
    @endslot

    <x-table class="align-middle">
        @slot('thead')
        <tr>
            <th>Payment</th>
            <th>Scheduled</th>
            <th>Job</th>
            <th>Contractor</th>
            <th>Status</th>
            <th class="text-center">
                <button id="selectAllButton" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-check2-square"></i>
                </button>
            </th>
        </tr>
        @endslot

        @foreach($work_orders as $work_order)
        <tr>
            <td style="width:1%">
                @include('payments.__.flag', ['status' => $work_order->payment_status])
            </td>
            <td class="text-nowrap">{{ $work_order->scheduled_date_human }}</td>
            <td class="text-nowrap">
                <a href="{{ route('work-orders.show', $work_order) }}" class="me-1">#{{ $work_order->id }}</a>
                @include('work-orders.__.job-flag', ['work_order' => $work_order, 'class' => 'd-inline-block'])
            </td>
            <td>
                @if( $work_order->hasContractor() )
                @include('contractors.__.flag', ['name' => $work_order->contractor->name, 'tooltip' => $work_order->contractor->alias])
                @endif
            </td>
            <td>
                @include('work-orders.__.status-flag', ['status' => $work_order->status])
            </td>
            <td class="text-center" style="width:1%">
                <input id="workOrder{{ $work_order->id }}Checkbox" class="form-check-input" type="checkbox" form="paymentUpdateForm" name="work_orders[]" value="{{ $work_order->id }}">
            </td>
        </tr>
        @endforeach
    </x-table>
</x-card>
<br>

<div class="px-3">
    <x-pagination-simple-model :collection="$work_orders" />
</div>

@push('scripts')
<script>
const selectAllButton = {
    trigger: document.getElementById('selectAllButton'),
    listen: function () {
        this.trigger.addEventListener('click', function (evt) {
            evt.preventDefault()

            document.querySelectorAll('input[type="checkbox"][id^="workOrder"]').forEach(function (item) {
                item.checked = !item.checked
            })
        })
    }
}
selectAllButton.listen()
</script>
@endpush

@include('payments.modal-filter')
@include('payments.modal-update')
@endsection
