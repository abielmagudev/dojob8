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
                <x-modal-trigger modal-id="modalClientNewAssessment">
                    <i class="bi bi-plus-lg"></i>
                </x-modal-trigger>
            </div>
        </div>
    </x-slot>

    @if( $assessments->isNotEmpty() )
    <x-table>
        <x-slot name="thead">
        <tr>
            <th>Order</th>
            <th>Schedule</th>
            <th>Contractor</th>
            <th>Client</th>
            <th class="text-nowrap">Work Orders</th>
            <th class="text-nowrap">Total</th>
            <th>Status</th>
            <th></th>
        </tr>
        </x-slot>

        @foreach($assessments as $assessment)
        <tr>
            <td class="text-center text-secondary" style="width:1%">{{ $assessment->ordered }}</td>
            <td>{{ $assessment->scheduled_date_human }}</td>
            <td>
                @if( $assessment->hasContractor() )
                @include('contractors.__.flag', [
                    'name' => $assessment->contractor->alias,
                    'tooltip' => $assessment->contractor->name,
                ]) 
                @endif
            </td>
            <td>
                @include('clients.__.inline-address-contact', [
                    'client' => $assessment->client
                ])
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
