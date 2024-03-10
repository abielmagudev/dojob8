@extends('application')

@section('header')
    <x-page-title>Inspections</x-page-title>
@endsection

@section('content')
    <x-card>

        @slot('title')
        <span class="badge text-bg-dark">{{ $inspections->total() }}</span>
        @endslot

        {{-- OPTIONS --}}
        @slot('options')
            <x-custom.form-scheduled-date :url="route('inspections.index')" />
        @endslot

        {{-- DROPOPTIONS --}}
        @slot('dropoptions')
            <li>
                @include('inspections.index.modal-edit-quickly')
            </li>

            <li>
                <hr class="dropdown-divider">
            </li>
            
            <li>
                <a href="{{ $pending_inspections['url'] }}" class="dropdown-item d-flex justify-content-between">
                    <div class="me-3">
                        <i class="bi bi-exclamation-triangle"></i>
                        <span class="ms-1">Pending</span>
                    </div>
                    <div>
                        <span class="badge border border-warning text-warning">{{ $pending_inspections['count'] }}</span>
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ $awaiting_inspections['url'] }}" class="dropdown-item d-flex justify-content-between">
                    <div class="me-3">
                        <i class="bi bi-alarm"></i>
                        <span class=" mx-1">Awaiting</span>
                    </div>
                    <div>
                        <span class="badge border border-primary text-primary">{{ $awaiting_inspections['count'] }}</span>
                    </div>
                </a>
            </li>
            <li>
                @include('inspections.index.modal-filtering')
            </li>
        @endslot

        {{-- BODY --}}
        @if( $inspections->count() )  
        <x-table>

            {{-- THEAD --}}
            <x-slot name="thead">
                <tr>
                    <th class="text-center">
                        <button class="btn btn-outline-primary btn-sm border-0" type="button" id="checkerButton">
                            <i class="bi bi-check2-square"></i>
                        </button>
                    </th>
                    <th>Status</th>

                    @if( $request->has('dates') )
                    <th>Scheduled</th>
                    @endif

                    <th>Agency</th>
                    <th>Inspector</th>
                    <th>Client</th>
                    <th>Job</th>
                    <th>Crew</th>
                    <th></th>
                </tr>
            </x-slot>
        
            {{-- TBODY --}}
            @foreach($inspections as $inspection)
            <tr>
                <td class="text-center">
                    @if(! $inspection->hasPending() )    
                    <input type="checkbox" class="form-check-input" name="inspections[]" value="{{ $inspection->id }}" form="formUpdateStatus">
                    @endif
                </td>

                <td style="width:1%">
                    @includewhen($inspection->hasNoPending(), 'inspections.__.flag-status', [
                        'status' => $inspection->status,
                        'class' => 'w-100',
                    ])

                    @includeWhen($inspection->hasPending(), 'components.custom.flag-pending')
                </td>

                @if( $request->has('dates') )
                <td class="text-nowrap">
                    @if( $inspection->hasScheduledDate() )
                    {{ $inspection->isToday() ? 'Today' : $inspection->scheduled_date_human }}
                    @endif
                </td>
                @endif

                <td class="text-nowrap">
                    {{ $inspection->agency->name }}
                </td>

                <td class="text-nowrap text-capitalize">
                    {{ $inspection->inspector_name }}
                </td>

                <td class="text-nowrap">
                    @include('clients.__.inline-address-contact', ['client' => $inspection->work_order->client])
                </td>

                <td class="text-nowrap">
                    @include('work-orders.__.summary-job', [
                        'work_order' => $inspection->work_order,
                    ])
                </td>

                <td class="text-nowrap text-center" style="width:1%">
                    @includeWhen($inspection->hasCrew(), 'crews.__.flag', [
                        'crew' => $inspection->crew,
                        'class' => 'w-100',
                    ])
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

@include('components.scripts.Checker')
<script>
const checker = new Checker('inspections');
checker.listen()
</script>

@endsection
