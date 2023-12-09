@extends('application')

@section('header')
<x-header title="Work orders">
    @slot('subtitle')
    <span class="badge text-bg-dark align-middle">{{ $work_orders->total() }}</span>
    @endslot
</x-header>
@endsection

@section('content')
<x-card>

    <x-slot name="title">
        @if( is_array($scheduled_casted) )
        <span class="text-nowrap">{{ $scheduled_casted[0]->format('D d, M y') }}</span>
        <span class="d-block d-md-inline-block mx-0 mx-md-1">to</span>
        <span class="text-nowrap">{{ $scheduled_casted[1]->format('D d, M y') }}</span>
    
        @else
        <span class="text-nowrap">{{ $scheduled_casted->format('D d, M y') }}</span>
    
        @endif
    </x-slot>

    @slot('options')
        <x-tooltip title="Views">
            <x-modal-trigger modal-id="modalWorkOrderViews" class="btn btn-primary d-none">
                <i class="bi bi-grid-1x2"></i>
            </x-modal-trigger>
        </x-tooltip>

        <div class="d-inline-block mx-3">
            <x-tooltip title="Unfinished until today">
                <a href="<?= $unfinished_work_orders['url'] ?>" class="btn btn-warning">
                    <i class="bi bi-alarm"></i>
                    <span>{{ $unfinished_work_orders['count'] }}</span>
                </a>
            </x-tooltip>
    
            <x-tooltip title="Filters">
                <x-modal-trigger modal-id="modalWorkOrdersFilter" class="btn btn-primary">
                    <i class="bi bi-funnel"></i>
                </x-modal-trigger>
            </x-tooltip>
        </div>

        <x-modal-trigger modal-id="modalSearchClient">
            <b>+</b>
        </x-modal-trigger>
    @endslot

    @if( $work_orders->count() ) 
    <x-table class="align-middle">

        @slot('thead')
        <tr>
            <th>Priority</th>
            <th>Crew</th>
            <th>Job</th>
            <th class="d-none">Contractor</th>
            <th>Client</th>
            <th>Scheduled</th>
            <th>Status</th>
            <th></th>
        </tr>
        @endslot

        @foreach($work_orders as $work_order)           
        <tr>

            <td>
                <input type="number" class="form-control form-control-sm" min="1" step="1" style="width:56px">
            </td>

            <td class="text-nowrap">
                <span 
                    class="badge w-100 p-2" 
                    style="background-color:{{ $work_order->crew->background_color }};color:{{ $work_order->crew->text_color }}"
                >
                    {{ $work_order->crew->name }}
                </span>
            </td>

            <td class="text-nowrap">
                <span class="d-block">{{ $work_order->job->name }}</span>
                <small>{{ $work_order->contractor->alias }}</small>
            </td>

            <td class="text-nowrap d-none">
                @if( $work_order->hasContractor() )
                <x-tooltip :title="$work_order->contractor->name">
                    <span class="badge text-bg-light" style="font-size:.9rem">{{ $work_order->contractor->alias }}</span>
                </x-tooltip>
                @endif
            </td>

            <td class="text-nowrap">
                @include('clients.__.address-table-cell', [
                    'client' => $work_order->client,
                    'except' => ['full_name'],
                ])
                @include('clients.__.contact-table-cell', [
                    'client' => $work_order->client, 
                ])
            </td>

            <td class="text-nowrap">
                @if(! $request->has('scheduled_date_range2') )
                <span class="d-block">{{ $work_order->scheduled_date_human }}</span>
                @endif

                <span>{{ $work_order->scheduled_time_human }}</span>
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
