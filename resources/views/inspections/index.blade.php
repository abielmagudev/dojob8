@extends('application')

@section('header')
    <x-page-title>Inspections</x-page-title>
@endsection

@section('content')
    <x-card title="{{ $inspections->total() }} inspections">

        {{-- OPTIONS --}}
        @slot('options')
            @include('components.custom.form-scheduled-date', [
                'url' => route('inspections.index')
            ])
        @endslot

        {{-- DROPOPTIONS --}}
        @slot('dropoptions')
        <li>
            <a href="{{ $pending_inspections['url'] }}" class="dropdown-item d-flex">
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
            <a href="{{ $awaiting_inspections['url'] }}" class="dropdown-item d-flex">
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
            <x-modal-trigger modal-id="modalFiltering" class="dropdown-item" link>
                <i class="bi bi-filter"></i>
                <span class="ms-1">More filters</span>
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
                    <th class="text-center">Status</th>

                    @if( $request->has('dates') )
                    <th>Scheduled</th>
                    @endif

                    <th>Agency</th>
                    <th>Inspector</th>
                    <th>Client</th>
                    <th>Job</th>
                    <th class="text-center">Crew</th>
                    <th></th>
                </tr>
            </x-slot>
        
            {{-- TBODY --}}
            @foreach($inspections as $inspection)
            <tr>
                <td class="text-center">
                    @if(! $inspection->isPending() )    
                    <input type="checkbox" class="form-check-input" name="inspections[]" value="{{ $inspection->id }}" form="formUpdateStatus">
                    @endif
                </td>

                <td style="width:1%">
                    @include('inspections.__.flag-status', [
                        'status' => $inspection->status,
                        'class' => 'w-100',
                    ])
                </td>

                @if( $request->has('dates') )
                <td class="text-nowrap">
                    @if( $inspection->hasScheduledDate() )
                    {{ $inspection->isToday() ? 'Today' : $inspection->scheduled_date_human }}
                        
                    @else
                    <div class="text-center text-secondary">
                        <b>?</b>
                    </div>

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

@include('inspections.index.modal-filtering')
@include('inspections.index.modal-modify-status')

@include('components.scripts.Checker')
<script>
const checker = new Checker('inspections');
checker.listen()
</script>

@endsection
