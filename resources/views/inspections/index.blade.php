@extends('application')

@section('header')
<x-page-title>Inspections</x-page-title>
@endsection

@section('content')
<x-card>

    @slot('title', "{$inspections->total()} Inspections")

    @slot('options')
    <form action="{{ route('inspections.index') }}" class="d-inline-block" method="get">
        <input type="date" class="form-control" name="scheduled_date" value="{{ $scheduled_date }}" onchange="this.closest('form').submit()">
    </form>
    @endslot

    @slot('dropoptions')
        <li>
            <a class="dropdown-item" href="{{ $pending_inspections['url'] }}">
                <i class="bi bi-exclamation-triangle"></i>
                <span class=" mx-1">Pending</span>
                <span class="badge text-bg-warning">{{ $pending_inspections['count'] }}</span>
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="{{ $on_hold_inspections['url'] }}">
                <i class="bi bi-alarm"></i>
                <span class=" mx-1">On hold</span>
                <span class="badge text-bg-warning">{{ $on_hold_inspections['count'] }}</span>
            </a>
        </li>
        <li>
            <x-modal-trigger modal-id="modalInspectionFilters" class="dropdown-item" link>
                <i class="bi bi-funnel"></i>
                <span class=" mx-1">More filters</span>
            </x-modal-trigger>
        </li>
    @endslot

    <x-table class="align-middle">
        <x-slot name="thead">
            <tr>
                <th>Status</th>
                <th>Scheduled</th>
                <th>Inspector</th>
                <th>Job</th>
                <th>Crew</th>
                <th>Client</th>
                <th class="text-nowrap">Work order</th>
                <th></th>
            </tr>
        </x-slot>
    
        @foreach($inspections as $inspection)
        <tr>
            <td style="width:1%">
                @include('inspections.__.status_color', ['status' => $inspection->status])
            </td>
            <td class="text-nowrap">{{ $inspection->isToday() ? 'Today' : $inspection->scheduled_date_human }}</td>
            <td class="text-nowrap">{{ $inspection->inspector->name }}</td>
            <td class="text-nowrap">{{ $inspection->work_order->job->name }}</td>
            <td class="text-nowrap">
                @if( $inspection->hasCrew() )
                    @include('crews.__.flag', [
                        'crew' => $inspection->crew,
                        'class' => 'w-100',
                    ])
                @endif
            </td>
            <td class="text-nowrap">
                @include('clients.__.address-table-cell', ['client' => $inspection->work_order->client])
            </td>
            <td>
                <a href="{{ route('work-orders.show', $inspection->work_order) }}" class="link-primary">#{{ $inspection->work_order->id }}</a>
            </td>
            <td class="text-end">
                <a href="{{ route('inspections.edit', $inspection) }}" class="btn btn-outline-warning">
                    <i class="bi bi-pencil-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </x-table>
</x-card>
<br>

<x-pagination-simple-model :collection="$inspections" />

@include('inspections.index.modal-inspection-filters')

@endsection
