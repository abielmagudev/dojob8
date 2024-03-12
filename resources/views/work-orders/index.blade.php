@extends('application')

@section('header')
<x-page-title>Work orders</x-page-title>
@endsection

@section('content')
<x-card>
    @slot('title')
    <span class="badge text-bg-dark">{{ $work_orders->total() }}</span>
    @endslot

    @slot('subtitle')
        @if( $request->has('dates') )
        <div class="d-flex">
            @if( $request->filled('dates.from') )
            <div>
                @if(! $request->filled('dates.to') )
                <span class="text-secondary">Since</span>
                @endif
                <span>{{ humanDateFormat( $request->input('dates.from') ) }} </span>
            </div>
            @endif

            @if( $request->filled('dates.from') && $request->filled('dates.to') )
            <span class="text-secondary mx-1">to</span>
            @endif

            @if( $request->filled('dates.to') )
            <div>
                @if(! $request->filled('dates.from') )
                <span class="text-secondary">Until</span>
                @endif
                <span>{{ humanDateFormat($request->input('dates.to')) }}</span> 
            </div>
            @endif
        </div>
        @endif

        @if( $request->has('search') )
        <div>
            <em>
                <span class="text-secondary">Searching:</span>
                {{ $request->get('search') }}
            </em>
        </div>
        @endif
    @endslot


    {{-- OPTIONS --}}
    @can('filter-work-orders')     
        @slot('options')
        <div class="d-inline-block align-middle">
            <x-custom.form-scheduled-date :url="route('work-orders.index')" />
        </div>
        @endslot
    @endcan

    {{-- DROPOPTIONS --}}
    @canAny(['create-work-orders', 'edit-work-orders', 'filter-work-orders'])
        @slot('dropoptions')
            @can('create-work-orders')       
            <li>
                <x-modal-trigger modal-id="modalClientNewWorkOrder" class="dropdown-item">
                    <i class="bi bi-plus-lg"></i>
                    <span class="ms-1">New work order</span>
                </x-modal-trigger>
            </li>
            @endcan
            
            @if( auth()->user()->can('edit-work-orders') )         
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                @include('work-orders.index.modals.modal-modify-status')
            </li>
            <li>
                @include('work-orders.index.dropoptions.form-update-ordered')
            </li>
            @endif
            
            @can('filter-work-orders')      
            <li>
                <hr class="dropdown-divider">
            </li> 

            @if( auth()->user()->can('edit-work-orders') || auth()->user()->hasRole('assessor') )          
            <li>
                @include('work-orders.index.dropoptions.button-pending')
            </li>
            @endif

            <li>
                @include('work-orders.index.dropoptions.button-incomplete')
            </li>

            @isset( $filtering )           
            <li>
                @include('work-orders.index.modals.modal-filtering')
            </li>
            @endisset

            @endcan
        @endslot
    @endcanAny

    {{-- BODY --}}
    @if( $work_orders->count() ) 
    <x-table>

        {{-- THEAD --}}
        @slot('thead')
        <tr>
            @if( $request->has('search') )            
            <th></th>
            @endif

            @if( auth()->user()->can('edit-work-orders') )               
            <th>
                @include('work-orders.index.components.button-checker')
            </th>
            @endif

            @if( $request->has('dates') )
            <th>Scheduled</th>
            @endif

            @can('edit-work-orders')                
            <th>Order</th>
            @endcan

            <th>Crew</th>
            <th>Job</th>
            <th>Client</th>
            <th>Contractor</th>
            <th>Status</th>
            @canAny(['see-work-orders', 'edit-work-orders'])
            <th></th>
            @endcanAny
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

            @if( auth()->user()->can('edit-work-orders') )               
            <td class="text-center" style="width:1%">
                @if(! $work_order->hasPending() )
                <input class="form-check-input" type="checkbox" form="formUpdateStatus" name="work_orders[]" value="{{ $work_order->id }}">
                @endif
            </td>
            @endif

            @if( $request->filled('dates') )
            <td class="text-nowrap">
                @if(! is_null($work_order->scheduled_date_human) )
                {{ $work_order->isToday() ? 'Today' : $work_order->scheduled_date_human }}
                @endif
            </td>
            @endif

            @can('edit-work-orders')                
            <td class="text-center" style="width:1%">
                @if( auth()->user()->can('edit-work-orders') )
                <input type="number" class="form-control form-control-sm" style="width:56px" min="1" step="1" name="ordered[{{ $work_order->id }}]" value="{{ $work_order->ordered }}" form="formWorkOrderOrdered">
                
                @else
                <span class="text-secondary">{{ $work_order->ordered }}</span>

                @endif
            </td>
            @endcan

            <td class="text-nowrap">
                @includeWhen($work_order->hasCrew(), 'crews.__.flag', [
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

            <td class="text-nowrap">
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
                    'class' => 'w-100',
                    'pending' =>$work_order->hasPending(),
                    'status' => $work_order->status,
                    'display' => 'd-block',
                ])
            </td>

            @canAny(['see-work-orders', 'edit-work-orders'])
            <td class="text-nowrap text-end" style="width:1%">

                @can('see-work-orders')                
                <a href="{{ route('work-orders.show', $work_order) }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-eye-fill"></i>
                </a>
                @endcan

                @can('edit-work-orders')                
                <a href="{{ route('work-orders.edit', [$work_order, 'url_back' => $request->fullUrl()]) }}" class="btn btn-outline-warning btn-sm">
                    <i class="bi bi-pencil-fill"></i>
                </a>
                @endcan

            </td>
            @endcanAny
        </tr>
        @endforeach

    </x-table>
    @endif
</x-card>
<br>

<div class="px-3">
    <x-pagination-simple-model :collection="$work_orders" />
</div>

@can('create-work-orders')
@include('work-orders.index.modals.modal-client-new-work-order')
@endcan
@endsection
