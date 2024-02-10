@extends('application')

@section('header')
<x-page-title>Work orders</x-page-title>
@endsection

@section('content')
<x-card title="{{ $work_orders->total() }}">
    @slot('options')
    <div class="d-inline-block align-middle ">
        <form action="{{ route('work-orders.index') }}" method="get" autocomplete="off">
            <input type="date" class="form-control" onchange="this.closest('form').submit()" name="scheduled_date" value="{{ $request->get('scheduled_date', date('Y-m-d')) }}">
        </form>
    </div>
    @endslot

    @slot('dropoptions')
    <li>
        <x-modal-trigger modal-id="modalSearchClientToCreateWorkOrder" class="dropdown-item">
            <i class="bi bi-plus-lg"></i>
            <span class="ms-1">Create</span>
        </x-modal-trigger>
    </li>
    <li>
        <hr class="dropdown-divider">
    </li>
    <li>
        <a href="<?= $incomplete_work_orders['url'] ?>" class="dropdown-item">
            <div class="float-end ms-3">
                <span class="badge text-bg-warning">{{ $incomplete_work_orders['count'] }}</span>
            </div>
            <div style="min-width:152px">
                <i class="bi bi-alarm"></i>
                <span class="ms-1">Incomplete</span>
            </div>
        </a>
    </li>
    <li>
        <x-modal-trigger modal-id="modalWorkOrdersFilter" class="dropdown-item">
            <i class="bi bi-funnel"></i>
            <span class="ms-1">More filters</span>
        </x-modal-trigger>
    </li>
    @endslot

    @if( $work_orders->count() ) 
    <x-table>

        @slot('thead')
        <tr>
            @if( $request->filled('fltr') )
            <th>Scheduled</th>
            @endif

            <th class="text-center">Priority</th>
            <th class="text-center">Crew</th>
            <th>Job</th>
            <th>Client</th>
            <th class="text-center">Contractor</th>
            <th class="text-center">Status</th>
            <th></th>
        </tr>
        @endslot

        @foreach($work_orders as $work_order)           
        <tr>
            @if( $request->filled('fltr') )
            <td class="text-nowrap">
                <span class="d-block">{{ ! $work_order->isToday() ? $work_order->scheduled_date_human : 'Today' }}</span>
            </td>
            @endif

            <td style="width:1%">
                <input type="number" class="form-control form-control-sm" min="1" step="1" style="width:56px">
            </td>

            <td class="text-nowrap" style="width:1%">
                @include('crews.__.flag', [
                    'crew' => $work_order->crew,
                    'class' => 'w-100',
                ])
            </td>
            
            <td class="text-nowrap">
                @include('work-orders.__.job-flag')
            </td>

            <td class="text-nowrap">
                @include('clients.__.accordion-address-contact', [
                    'client' => $work_order->client,
                ])
            </td>

            <td class="text-nowrap" style="width:1%">
                @if( $work_order->hasContractor() )    
                    @include('contractors.__.flag', [
                        'name' => $work_order->contractor->alias,
                        'tooltip' => $work_order->contractor->name,
                        'class' => 'w-100',
                    ])
                @endif
            </td>

            <td style="width:1%">
                @include('work-orders.__.status-flag', [
                    'status' => $work_order->status,
                    'class' => 'w-100',
                ])
            </td>

            <td class="text-nowrap text-end" style="width:1%">
                <a href="{{ route('work-orders.edit', [$work_order, 'url_back' => $request->fullUrl()]) }}" class="btn btn-outline-warning btn-sm">
                    <i class="bi bi-pencil-fill"></i>
                </a>
                <a href="{{ route('work-orders.show', [$work_order, 'url_back' => $request->fullUrl()]) }}" class="btn btn-outline-primary btn-sm">
                    <span>#{{ $work_order->id }}</span>
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

@include('work-orders.index.modal-filtering')

@include('work-orders.index.modal-search-client-to-create-work-order')

@endsection
