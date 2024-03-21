@extends('application')

@section('header')
<x-page-title>Assessments</x-page-title>
@endsection

@section('content')
<x-card>
    <x-slot name="title">
        <span class="badge bg-dark">{{ $assessments->total() }}</span>
    </x-slot>

    <x-slot name="options">
        <div class="d-flex gap-2">
            <div>
                <x-custom.form-scheduled-date url="{{ route('assessments.index') }}" />
            </div>
            <div>
                
            </div>
        </div>
    </x-slot>

    <x-slot name="dropoptions">
        <li>
            <x-modal-trigger modal-id="modalClientNewAssessment" class="dropdown-item">
                <i class="bi bi-plus-lg"></i>
                <span>New assessment</span>
            </x-modal-trigger>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li>
            @include('assessments.inc.modal-filters')
        </li>
    </x-slot>

    @if( $assessments->isNotEmpty() )
    <x-table>
        <x-slot name="thead">
        <tr>
            <th>Order</th>
            <th>Schedule</th>
            <th>Type</th>
            <th>Client</th>
            <th>Contractor</th>
            <th class="text-nowrap">Work Orders</th>
            <th>Status</th>
            <th></th>
        </tr>
        </x-slot>

        @foreach($assessments as $assessment)
        <tr>
            <td class="text-center text-secondary" style="width:1%">{{ $assessment->ordered }}</td>
            <td>{{ $assessment->scheduled_date_human }}</td>
            <td class="text-capitalize">{{ $assessment->type }}</td>
            <td>
                @include('clients.__.inline-address-contact', [
                    'client' => $assessment->client
                ])
            </td>
            <td>
                @if( $assessment->hasContractor() )
                @include('contractors.__.flag', [
                    'name' => $assessment->contractor->alias,
                    'tooltip' => $assessment->contractor->name,
                ]) 
                @endif
            </td>
            <td class="text-center">{{ $assessment->work_orders_counter }}</td>
            <td class="text-center">
                <x-assessments.status value="{{ $assessment->status }}"></x-assessments.status>
            </td>
            <td class="text-nowrap text-end">
                <a href="{{ route('assessments.show', $assessment) }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-eye-fill"></i>
                </a>
                <a href="{{ route('assessments.edit', $assessment) }}" class="btn btn-outline-warning btn-sm">
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
    <x-pagination-simple-model :collection="$assessments" />
</div>

@include('assessments.inc.modal-client-new-assessment')
@endsection
