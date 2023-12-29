@extends('application')

@section('header')
<x-header title="Work orders" />
@endsection

@section('content')
<x-card>

    @slot('title')
        @if( is_array($scheduled_casted) )
        <span class="text-nowrap">{{ $scheduled_casted[0]->format('D d, M y') }}</span>
        <span class="d-block d-md-inline-block mx-0 mx-md-1">to</span>
        <span class="text-nowrap">{{ $scheduled_casted[1]->format('D d, M y') }}</span>
    
        @else
        <span class="text-nowrap">{{ $scheduled_casted->format('D d, M y') }}</span>
    
        @endif
    @endslot

    @slot('options')
        <div class="d-inline-block">
            <x-tooltip title="Views">
                <x-modal-trigger modal-id="modalWorkOrderViews" class="btn btn-primary d-none">
                    <i class="bi bi-grid-1x2"></i>
                </x-modal-trigger>
            </x-tooltip>
    
        
        </div>

        <div class="d-inline-block align-middle ">
            <form action="{{ route('work-orders.index') }}" method="get" autocomplete="off">
                <input type="date" class="form-control" onchange="this.closest('form').submit()" name="scheduled_date" value="{{ $request->get('scheduled_date', date('Y-m-d')) }}">
            </form>
        </div>

        
        @slot('dropoptions')
            <li>
                <x-modal-trigger modal-id="modalSearchClient" class="dropdown-item">
                    <i class="bi bi-plus-lg"></i>
                    <span class="ms-1">Create</span>
                </x-modal-trigger>
            </li>
            <li>
                <a href="<?= $unfinished_work_orders['url'] ?>" class="dropdown-item">
                    <div class="float-end ms-3">
                        <span class="badge text-bg-warning">{{ $unfinished_work_orders['count'] }}</span>
                    </div>
                    <div style="min-width:152px">
                        <i class="bi bi-alarm"></i>
                        <span class="ms-1">Unfinished</span>
                    </div>
                </a>
            </li>
            <li>
                <x-modal-trigger modal-id="modalWorkOrdersFilter" class="dropdown-item">
                    <i class="bi bi-funnel"></i>
                    <span class="ms-1">Filters</span>
                </x-modal-trigger>
            </li>
        @endslot
    @endslot

    @if( $work_orders->count() ) 
    <x-table class="align-middle">

        @slot('thead')
        <tr>
            @if( $request->filled('scheduled_date_range') )
            <th>Scheduled</th>
            @endif
            <th>Priority</th>
            <th>Crew</th>
            <th>Contractor</th>
            <th>Job</th>
            <th>Client</th>
            <th>Status</th>
            <th></th>
        </tr>
        @endslot

        @foreach($work_orders as $work_order)           
        <tr>
            @if( $request->filled('scheduled_date_range') )
            <td class="text-nowrap">
                <span class="d-block">{{ $work_order->scheduled_date_human }}</span>
            </td>
            @endif

            <td>
                <input type="number" class="form-control form-control-sm" min="1" step="1" style="width:56px">
            </td>

            <td class="text-nowrap">
                <span 
                    class="badge w-100" 
                    style="background-color:{{ $work_order->crew->background_color }};color:{{ $work_order->crew->text_color }}"
                >
                    {{ $work_order->crew->name }}
                </span>
            </td>

            <td class="text-nowrap">
                @if( $work_order->hasContractor() )
                <x-tooltip :title="$work_order->contractor->name" class="d-block">
                    <span class="badge text-bg-light w-100">{{ $work_order->contractor->alias }}</span>
                </x-tooltip>

                @else
                <span class="badge bg-light text-secondary w-100">N/A</span>
                    
                @endif
            </td>
            
            <td class="text-nowrap">
                {{ $work_order->job->name }}
            </td>


            <td class="text-nowrap">
                @include('clients.__.address-table-cell', [
                    'client' => $work_order->client,
                ])
            </td>

            <td class="text-nowrap text-uppercase">
                <span class="badge w-100 {{ $work_order->status_color }}">{{ $work_order->status }}</span>
            </td>

            <td class="text-nowrap text-end">
                <a href="{{ route('work-orders.edit', $work_order) }}" class="btn btn-outline-warning">
                    <i class="bi bi-pencil-fill"></i>
                </a>
                <a href="{{ route('work-orders.show', $work_order) }}" class="btn btn-outline-primary">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </td>

        </tr>
        @endforeach

    </x-table>
    @endif

</x-card>
<br>

<x-pagination-simple-eloquent :collection="$work_orders" />

@include('work-orders.index.modal-work-order-views')
@include('work-orders.index.modal-work-orders-filter')
@include('clients.__.modal-search')

@endsection
