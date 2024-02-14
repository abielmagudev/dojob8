@extends('application')

@section('header')
<x-page-title>Payments</x-page-title>
@endsection

@section('content')
<x-card title="{{ $work_orders->total() }} Work Orders" header-wrap>
    
    @slot('options')
        @include('components.custom.form-scheduled-date', ['route' => route('payments.index')])
    @endslot

    @slot('dropoptions')
    <li>
        <x-modal-trigger modal-id="updatePaymentsModal" class="dropdown-item">
            <i class="bi bi-arrow-counterclockwise"></i>
            <span class="ms-1">Update selected</span>
        </x-modal-trigger>
    </li>
    <li>
        <hr class="dropdown-divider">
    </li>
    <li>
        <x-modal-trigger modal-id="filterPaymentsModal" class="dropdown-item">
            <i class="bi bi-filter"></i>
            <span class="ms-1">More filters</span>
        </x-modal-trigger>
    </li>
    @endslot

    @if( $work_orders->count() )
    <x-table class="align-top">
        @slot('thead')
        <tr>
            <th>
                <button id="checkerButton" class="btn btn-outline-primary btn-sm border-0">
                    <i class="bi bi-check2-square"></i>
                </button>
            </th>

            @if( $request->filled('dates') )
            <th>Scheduled</th>
            @endif

            <th>Payment</th>
            <th>Job</th>
            <th>Client</th>
            <th class="text-center">Contractor</th>
            <th class="text-center">Status</th>
            <th></th>
        </tr>
        @endslot

        @foreach($work_orders as $work_order)
        <tr>
            <td class="text-center" style="width:1%">
                <input class="form-check-input" type="checkbox" form="paymentUpdateForm" name="work_orders[]" value="{{ $work_order->id }}">
            </td>

            @if( $request->has('dates') )
            <td class="text-nowrap">
                <span>{{ $work_order->scheduled_date_human }}</span>
            </td>
            @endif
            
            <td class="text-center" style="width:1%">
                @include('payments.__.flag', [
                    'status' => $work_order->payment_status,
                    'class' => 'w-100',
                ])
            </td>

            <td class="text-nowrap">
                @include('work-orders.__.job-flag')
            </td>

            <td class="text-nowrap">
                @include('clients.__.inline-address-contact', [
                    'client' => $work_order->client
                ])
            </td>

            <td class="text-center">
                @if( $work_order->hasContractor() )
                @include('contractors.__.flag', [
                    'name' => $work_order->contractor->alias, 
                    'tooltip' => $work_order->contractor->name,
                    'class' => 'w-100',
                ])
                @endif
            </td>

            <td class="text-center">
                @include('work-orders.__.status-flag', [
                    'status' => $work_order->status,
                    'class' => 'w-100'
                ])
            </td>

            <td>
                <a href="{{ route('work-orders.show', $work_order) }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-eye-fill"></i>    
                </a>
            </td>
        </tr>
        @endforeach
    </x-table>
    @endif
</x-card>
<br>

<div class="px-3">
    <x-pagination-simple-model :collection="$work_orders" />
</div>

@include('components.scripts.Checker')
<script>
const checker = new Checker('work_orders');
checker.listen()
</script>

@include('payments.index.modal-filter')
@include('payments.index.modal-update')
@endsection
