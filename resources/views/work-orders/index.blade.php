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
            <x-modal-trigger modal-id="modalWorkOrderViews" class="btn btn-primary">
                <i class="bi bi-grid-1x2"></i>
            </x-modal-trigger>
        </x-tooltip>

        <div class="btn-group mx-3">
            <x-tooltip title="Filters">
                <x-modal-trigger modal-id="modalWorkOrdersFilter" class="btn btn-primary rounded-end-0">
                    <i class="bi bi-funnel"></i>
                </x-modal-trigger>
            </x-tooltip>

            <x-tooltip title="Unsolved until today">
                <a href="<?= $url_unsolved_button ?>" class="btn btn-danger rounded-start-0">
                    <i class="bi bi-stopwatch"></i>
                </a>
            </x-tooltip>
        </div>

        <x-modal-trigger modal-id="modalSearchClient">
            <b>+</b>
        </x-modal-trigger>
    @endslot

    @if( $work_orders->count() ) 
    <x-table>
        <x-slot name="thead">
        <tr class="text-center">
            <th>Priority</th>
            <th>Scheduled</th>
            <th>Crew</th>
            <th>Job</th>
            <th class="text-start">Client</th>
            <th>Contractor</th>
            <th>Status</th>
            <th></th>
        </tr>
        </x-slot>

        @foreach($work_orders as $work_order)           
        <tr class="text-center">
            <td>
                <input type="number" class="form-control form-control-sm" min="1" step="1" style="width:56px">
            </td>
            <td class="text-nowrap">
                @if( is_array($scheduled_casted) )
                <span class="d-block">{{ $work_order->scheduled_date_human }}</span>
                @endif
                <span>{{ $work_order->scheduled_time_human }}</span>
            </td>
            <td class="text-nowrap">
                @if( $work_order->hasCrew() )
                <span 
                    class="badge w-100 {{ $work_order->crew->hasColor() ? '' : 'text-bg-dark' }}" 
                    @if( $work_order->crew->hasColor() ) 
                        style="background-color:{{ $work_order->crew->color }}" 
                    @endif
                >
                    {{ $work_order->crew->name }}
                </span>
                @endif
            </td>
            <td class="text-nowrap">{{ $work_order->job->name }}</td>
            <td class="text-nowrap text-start">
                <div>
                    <span>{{ $work_order->client->address }}, </span>
                    <b>{{ $work_order->client->zip_code }} - D{{ $work_order->client->district_code }}</b>
                </div>
                <small>
                    <span>{{ $work_order->client->full_name }}</span>
                    @foreach($work_order->client->contact_data_api_html as $data)
                    <div class="badge text-bg-light mx-1">{!! $data !!}</div>
                    @endforeach
                    <div class="badge text-bg-light">
                        <a href="{{ $work_order->client->google_maps_url_search_address }}" target="_blank">
                            Google maps
                        </a>
                    </div>
                </small>
            </td>
            <td class="text-nowrap">
                @if( $work_order->hasIntermediary() )
                <x-tooltip :title="$work_order->intermediary->name">
                    <span class="badge text-bg-light" style="font-size:.9rem">{{ $work_order->intermediary->alias }}</span>
                </x-tooltip>
                @endif
            </td>
            <td class="text-nowrap text-uppercase">
                <span class="badge w-100 {{ $work_order->status_color }}">{{ $work_order->status_text }}</span>
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
@include('clients.modal-search')

@endsection
