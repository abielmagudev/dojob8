@extends('application')

@section('header')
    <x-page-title>Inspections</x-page-title>
@endsection

@section('content')
    <x-card title="{{ $inspections->total() }} inspections">

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
                <a class="dropdown-item" href="{{ $awaiting_inspections['url'] }}">
                    <i class="bi bi-alarm"></i>
                    <span class=" mx-1">Awaiting</span>
                    <span class="badge text-bg-primary">{{ $awaiting_inspections['count'] }}</span>
                </a>
            </li>
            <li>
                <x-modal-trigger modal-id="modalInspectionFilters" class="dropdown-item" link>
                    <i class="bi bi-funnel"></i>
                    <span class=" mx-1">Filters</span>
                </x-modal-trigger>
            </li>
        @endslot

        @if( $inspections->count() )  
        <x-table>
            <x-slot name="thead">
                <tr>
                    <th class="text-center">Status</th>
                    <th>Scheduled</th>
                    <th>Agency</th>
                    <th>Inspector</th>
                    <th>Client</th>
                    <th>Job</th>
                    <th class="text-center">Crew</th>
                    <th></th>
                </tr>
            </x-slot>
        
            @foreach($inspections as $inspection)
            <tr>
                <td style="width:1%">
                    @include('inspections.__.status-flag', [
                        'status' => $inspection->status,
                        'class' => 'w-100',
                    ])
                </td>

                <td class="text-nowrap">
                    @if( $inspection->hasScheduledDate() )
                    {{ $inspection->isToday() ? 'Today' : $inspection->scheduled_date_human }}
                        
                    @else
                    <div class="text-center text-secondary">
                        <b>?</b>
                    </div>

                    @endif
                </td>

                <td class="text-nowrap">
                    {{ $inspection->agency->name }}
                </td>

                <td class="text-nowrap text-capitalize">
                    {{ $inspection->inspector_name }}
                </td>

                <td class="text-nowrap">
                    @include('clients.__.accordion-address-contact', ['client' => $inspection->work_order->client])
                </td>

                <td class="text-nowrap">
                    {{ $inspection->work_order->job->name }}
                </td>

                <td class="text-nowrap text-center">
                @if( $inspection->hasCrew() )
                    @include('crews.__.flag', [
                        'crew' => $inspection->crew,
                    ])
                @endif
                </td>

                <td class="text-end">
                    <a href="{{ route('inspections.edit', [$inspection, 'url_back' => $request->fullUrl()]) }}" class="btn btn-outline-warning btn-sm">
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
        <x-pagination-simple-model :collection="$inspections" />
    </div>

@include('inspections.index.modal-filtering')
@endsection
