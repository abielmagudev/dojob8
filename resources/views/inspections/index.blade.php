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

    @if( is_array($scheduled_casted) )      
    @slot('title')
    <span>{{ $scheduled_casted[0]->format('d M, Y') }}</span>
    <span class="mx-1">to</span>
    <span>{{ $scheduled_casted[1]->format('d M, Y') }}</span>
    @endslot
    @endif

    @slot('options')
    <x-tooltip title="Pending inspections">
        <a href="{{ $pending_inspections['url'] }}" class="btn btn-warning">
            <i class="bi bi-alarm"></i>
            <span>{{ $pending_inspections['count'] }}</span>
        </a>
    </x-tooltip>
    <x-tooltip title="Filters">
        <x-modal-trigger modal-id="modalInspectionFilters">
            <i class="bi bi-funnel"></i>
        </x-modal-trigger>
    </x-tooltip>
    @endslot

    <x-table class="align-middle">
        <x-slot name="thead">
            <tr>
                <th>Status</th>
                <th>Scheduled</th>
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
            <td class="text-nowrap">{{ $inspection->isToday() ? 'Today' : $inspection->scheduled_date_human }}</td>
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
