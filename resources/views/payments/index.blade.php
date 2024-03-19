@extends('application')

@section('header')
<x-page-title>Payments</x-page-title>
@endsection

@section('content')
<x-card>
    @slot('title')
    <span class="badge text-bg-dark">{{ $payments->total() }}</span>
    @endslot    

    {{-- OPTIONS --}}
    @slot('options')
        @include('components.custom.form-scheduled-date', [
            'url' => route('payments.index')
        ])
    @endslot

    {{-- DROPOPTIONS --}}
    @slot('dropoptions')
    <li>
        <x-modal-trigger modal-id="modalEditQuicklyPayments" class="dropdown-item">
            <i class="bi bi-pencil-square"></i>
            <span class="ms-1">Edit quickly</span>
        </x-modal-trigger>
    </li>
    <li>
        <hr class="dropdown-divider">
    </li>
    <li>
        <a href="{{ $filtering['unpaid']['url'] }}" class="dropdown-item d-flex justify-content-between">
            <div class="me-3">
                <i class="bi bi-alarm"></i>
                <span class="ms-1">Unpaid</span>
            </div>
            <div>
                <span class="badge border border-warning text-warning">{{ $filtering['unpaid']['count'] }}</span>
            </div>
        </a>
    </li>
    <li>
        <x-modal-trigger modal-id="modalFiltering" class="dropdown-item">
            <i class="bi bi-filter"></i>
            <span class="ms-1">More filters</span>
        </x-modal-trigger>
    </li>
    @endslot

    {{-- BODY --}}
    @if( $payments->count() )
    <x-table class="align-top">

        {{-- THEAD --}}
        @slot('thead')
        <tr>
            <th>
                <button id="checkerButton" class="btn btn-outline-primary btn-sm border-0">
                    <i class="bi bi-check2-square"></i>
                </button>
            </th>

            <th>Payment</th>

            @if( $request->filled('dates') )
            <th>Scheduled</th>
            @endif

            <th>Job</th>
            <th>Client</th>
            <th class="text-center">Contractor</th>
            <th>Total</th>
            <th class="text-center">Status</th>
            <th></th>
        </tr>
        @endslot

        {{-- TBODY --}}
        @foreach($payments as $payment)
        <tr>
            <td class="text-center" style="width:1%">
                <input class="form-check-input" type="checkbox" form="formEditQuicklyPayments" name="payments[]" value="{{ $payment->id }}">
            </td>

            <td class="text-center" style="width:1%">
                @include('payments.__.flag-status', [
                    'status' => $payment->status,
                    'class' => 'w-100',
                ])
            </td>

            @if( $request->has('dates') )
            <td class="text-nowrap">
                <span>{{ $payment->work_order->scheduled_date_human }}</span>
            </td>
            @endif

            <td class="text-nowrap">
                @include('work-orders.__.summary-job', [
                    'work_order' => $payment->work_order
                ])
            </td>

            <td class="text-nowrap">
                @include('clients.__.inline-address-contact', [
                    'client' => $payment->work_order->client
                ])
            </td>

            <td class="text-center">
            @if( $payment->work_order->hasContractor() )
                @include('contractors.__.flag', [
                    'name' => $payment->work_order->contractor->alias, 
                    'tooltip' => $payment->work_order->contractor->name,
                    'class' => 'w-100',
                ])
            @endif
            </td>

            <td>
                <span class="currency-symbol">{{ mt_rand(0.01, 999.99) }}</span>
            </td>
            
            <td class="text-center">
                @include('work-orders.__.flag-status', [
                    'status' => $payment->work_order->status,
                    'class' => 'w-100',
                ])
            </td>
            
            <td class="text-end">
                <a href="{{ route('work-orders.show', $payment->work_order) }}" class="btn btn-outline-primary btn-sm">
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
    <x-pagination-simple-model :collection="$payments" />
</div>

@include('components.scripts.Checker')
<script>
const checker = new Checker('payments');
checker.listen()
</script>

@include('payments.index.modal-filtering')
@include('payments.index.modal-edit-quickly')
@endsection
