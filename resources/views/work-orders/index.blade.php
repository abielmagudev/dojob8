@extends('application')

@section('header')
<x-page-title>Work orders</x-page-title>
@endsection

@section('content')
<x-card title="{{ $work_orders->total() }}" subtitle="{{ $request->has('search') ? sprintf('Searching: %s', $request->get('search')) : '' }}">
    
    {{-- OPTIONS --}}
    @slot('options')
    <div class="d-inline-block align-middle ">
        @include('components.custom.form-scheduled-date', [
            'url' => route('work-orders.index')
        ])
    </div>
    @endslot

    {{-- DROPOPTIONS --}}
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
        <x-modal-trigger modal-id="modalModifyStatus" class="dropdown-item">
            <i class="bi bi-pencil-square"></i>
            <span class="ms-1">Modify status</span>
        </x-modal-trigger>
        <form action="{{ route('work-orders.update.ordered') }}" method="post" id="formWorkOrderOrdered">
            @method('patch')
            @csrf
            <input type="hidden" name="url_back" value="{{ $request->fullUrl() }}">
            <button class="dropdown-item">
                <i class="bi bi-floppy"></i>
                <span class="ms-1">Update order</span>
            </button>
        </form>
    </li>

    <li>
        <hr class="dropdown-divider">
    </li>
    <li>
        <a href="<?= $incomplete_work_orders['url'] ?>" class="dropdown-item d-flex">
            <div class="me-3">
                <i class="bi bi-alarm"></i>
                <span class="ms-1">Incomplete</span>
            </div>
            <div>
                <span class="badge border border-warning text-warning">{{ $incomplete_work_orders['count'] }}</span>
            </div>
        </a>
    </li>
    <li>
        <x-modal-trigger modal-id="modalWorkOrdersFilter" class="dropdown-item">
            <i class="bi bi-filter"></i>
            <span class="ms-1">More filters</span>
        </x-modal-trigger>
    </li>
    @endslot

    {{-- BODY --}}
    @if( $work_orders->count() ) 
    <x-table>

        {{-- THEAD --}}
        @slot('thead')
        <tr>
            @if( $request->has('search') )            
            <th></th>
            @endif

            <th>
                <button id="checkerButton" class="btn btn-outline-primary btn-sm border-0">
                    <i class="bi bi-check2-square"></i>
                </button>
            </th>

            @if( $request->has('dates') )
            <th>Scheduled</th>
            @endif

            <th class="text-center">Order</th>
            <th class="text-center">Crew</th>
            <th>Job</th>
            <th>Client</th>
            <th class="text-center">Contractor</th>
            <th class="text-center">Status</th>
            <th></th>
        </tr>
        @endslot

        {{-- TBODY --}}
        @foreach($work_orders as $work_order)           
        <tr>            
            @if( $request->has('search') )            
            <td class="text-center text-secondary" style="width:1%">
                {!! marker($request->get('value', ''), $work_order->id) !!}
            </td>
            @endif

            <td class="text-center" style="width:1%">
                @if(! $work_order->qualifiesForPendingStatus() )
                <input class="form-check-input" type="checkbox" form="formUpdateStatus" name="work_orders[]" value="{{ $work_order->id }}">
                @endif
            </td>

            @if( $request->filled('dates') )
            <td class="text-nowrap">
                @if(! is_null($work_order->scheduled_date_human) )
                <span>{{ $work_order->isToday() ? 'Today' : $work_order->scheduled_date_human }}</span>
                
                @else
                <span class="d-block text-center text-secondary">?</span>

                @endif
            </td>
            @endif

            <td style="width:1%">
                <input type="number" class="form-control form-control-sm" style="width:56px" min="1" step="1" name="ordered[{{ $work_order->id }}]" value="{{ $work_order->ordered }}" form="formWorkOrderOrdered">
            </td>

            <td class="text-nowrap">
                @include('crews.__.flag', [
                    'crew' => $work_order->crew,
                    'class' => 'w-100',
                ])
            </td>
            
            <td class="text-nowrap">
                @include('work-orders.__.summary-job')
            </td>

            <td class="text-nowrap">
                @include('clients.__.inline-address-contact', [
                    'client' => $work_order->client,
                ])
            </td>

            <td class="text-nowrap text-center">
                @if( $work_order->hasContractor() )    
                    @include('contractors.__.flag', [
                        'name' => $work_order->contractor->alias,
                        'tooltip' => $work_order->contractor->name,
                        'class' => 'w-100',
                    ])
                @endif
            </td>

            <td>
                @include('work-orders.__.flag-status', [
                    'status' => $work_order->status,
                    'class' => 'w-100',
                ])
            </td>

            <td class="text-nowrap text-end" style="width:1%">
                <a href="{{ route('work-orders.show', $work_order) }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-eye-fill"></i>
                </a>
                <a href="{{ route('work-orders.edit', [$work_order, 'url_back' => $request->fullUrl()]) }}" class="btn btn-outline-warning btn-sm">
                    <i class="bi bi-pencil-fill"></i>
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

@include('work-orders.index.modal-modify-status')
@include('work-orders.index.modal-filtering')
@include('work-orders.index.modal-search-client-to-create-work-order')
@endsection
