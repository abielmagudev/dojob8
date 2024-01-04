@extends('application')

@section('header')
<x-header title="Inspections">
    @slot('subtitle')
    <span class="badge text-bg-dark">{{ $inspections->total() }}</span>
    @endslot
</x-header>
@endsection

@section('content')
<x-card>

    
    @slot('title')
    @if( is_array($scheduled_casted) )  
    <span>{{ $scheduled_casted[0]->format('d M, Y') }}</span>
    <span class="mx-1">to</span>
    <span>{{ $scheduled_casted[1]->format('d M, Y') }}</span>

    @else
    <span>{{ now()->format('d M, Y') }}</span>

    @endif

    @endslot



    @slot('options')
    <form action="{{ route('inspections.index') }}" class="d-inline-block" method="get">
        <input type="date" class="form-control" name="scheduled_date" value="{{ $scheduled_date }}" onchange="this.closest('form').submit()">
    </form>
    @endslot

    @slot('dropoptions')
        <li>
            <a class="dropdown-item" href="{{ $pending_inspections['url'] }}">
                <span class="">
                    <i class="bi bi-alarm"></i>
                </span>
                <span class=" mx-1">Pending</span>
                <span class="badge text-bg-warning">{{ $pending_inspections['count'] }}</span>
            </a>
        </li>
        <li>
            <x-modal-trigger modal-id="modalInspectionFilters" class="dropdown-item" link>
                <span class="">
                    <i class="bi bi-funnel"></i>
                </span>
                <span class=" mx-1">Filter</span>
            </x-modal-trigger>
        </li>
    @endslot

    <x-table class="align-middle">
        <x-slot name="thead">
            <tr>
                <th>Status</th>
                {{-- @if(! $request->filled('scheduled_date') ) --}}
                <th>Scheduled</th>
                {{-- @endif --}}
                <th>Inspector</th>
                <th>Crew</th>
                <th>Job</th>
                <th>Client</th>
                <th></th>
            </tr>
        </x-slot>
    
        @foreach($inspections as $inspection)
        <tr>
            <td style="max-width:128px">
                <x-badge color="{{ $inspection->status_color }}" class="text-uppercase w-100">{{ $inspection->status }}</x-badge>
            </td>

            {{-- @if(! $request->filled('scheduled_date') ) --}}
            <td class="text-nowrap">{{ $inspection->isToday() ? 'Today' : $inspection->scheduled_date_human }}</td>
            {{-- @endif --}}

            <td class="text-nowrap">{{ $inspection->inspector->name }}</td>
            <td class="text-nowrap">
                @if( $inspection->hasCrew() )
                <span class="badge" style="background-color:{{ $inspection->crew->background_color }};color: {{ $inspection->crew->text_color }}">{{ $inspection->crew->name }}</span>
                @endif
            </td>
            <td class="text-nowrap">{{ $inspection->work_order->job->name }}</td>
            <td class="text-nowrap">
                @include('clients.__.address-table-cell', ['client' => $inspection->work_order->client])
            </td>
            <td class="text-end">
                <a href="{{ route('inspections.show', $inspection) }}" class="btn btn-outline-primary">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </x-table>
</x-card>
<br>

<x-pagination-simple-eloquent :collection="$inspections" />

@include('inspections.index.modal-inspection-filters')

@endsection
