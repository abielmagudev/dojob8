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

    <button id="selectAllButton" class="btn btn-primary">
        <i class="bi bi-check-all"></i>
    </button>

    <x-modal-trigger modal-id="updatePaymentsModal" class="btn btn-warning">
        <i class="bi bi-arrow-clockwise"></i>
    </x-modal-trigger>
    @endslot

    <x-table class="align-middle">
        @slot('thead')
        <tr>
            <th>Status</th>
            <th>Scheduled</th>
            <th>Job</th>
            <th>Contractor</th>
            <th></th>
        </tr>
        @endslot

        @foreach($work_orders as $work_order)
        <tr>
            <td>
                @include('payments.__.flag', ['status' => $work_order->payment_status])
            </td>
            <td class="text-nowrap">{{ $work_order->scheduled_date_human }}</td>
            <td class="text-nowrap">
                <a href="{{ route('work-orders.show', $work_order) }}">#{{ $work_order->id }}</a>
                <span>- {{ $work_order->job->name }}</span>
            </td>
            <td>
                @if( $work_order->hasContractor() )
                @include('contractors.__.flag', ['name' => $work_order->contractor->name, 'tooltip' => $work_order->contractor->alias])
                @endif
            </td>
            <td class="text-center" style="width:1%">
                <div class="form-check">
                    <input id="workOrder{{ $work_order->id }}Checkbox" class="form-check-input" type="checkbox" name="process" value="">
                </div>
            </td>
        </tr>
        @endforeach
    </x-table>
</x-card>

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
