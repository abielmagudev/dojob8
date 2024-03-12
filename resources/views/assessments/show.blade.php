@extends('application')

@section('header')
<x-page-title>Assessment #{{ $assessment->id }}</x-page-title>    
@endsection
@section('content')
<div class="row">
    <div class="col-sm col-sm-4">
        <x-card>
            <x-slot name="title">
                <x-assessments.status value="{{ $assessment->status }}" />
            </x-slot>

            <x-slot name="options">
                <a href="{{ route('assessments.edit', $assessment) }}" class="btn btn-warning">
                    <i class="bi bi-pencil-fill"></i>
                </a>
            </x-slot>

            <x-small-title title="Client">
                <b>{{ $assessment->client->full_name }}</b>
                <br>
                <small>
                    {{ $assessment->client->address_simple }}
                    <br>
                    {{ $assessment->client->contact_channels }}
                </small>
            </x-small-title>

            <x-small-title title="Contractor">
                {{ $assessment->hasContractor() ? $assessment->contractor->name : '' }}
            </x-small-title>

            <x-small-title title="Notes">
                {{ $assessment->notes }}
            </x-small-title>
        </x-card>
    </div>

    <div class="col-sm">
        <x-card title="Work orders">
            <x-slot name="options">
                <a href="{{ route('work-orders.create', ['assessment' => $assessment->id]) }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i>
                </a>
            </x-slot>

            @if( $assessment->hasWorkOrders() )
            <x-table>
                <x-slot name="thead">
                <tr>
                    <th>Order</th>
                    <th>Job</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                </x-slot>

                @foreach($assessment->work_orders as $work_order)
                <tr>
                    <td class="text-center text-secondary" style="width:1%">{{ $work_order->ordered }}</td>
                    <td>{{ $work_order->job->name }}</td>
                    <td class="text-center">
                        @include('work-orders.__.flag-status', [
                            'status' => $work_order->status,
                        ])
                    </td>
                    <td class="text-end">
                        <a href="{{ route('work-orders.show', $work_order) }}" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-eye-fill"></i>
                        </a>
                        <a href="{{ route('work-orders.edit', $work_order) }}" class="btn btn-outline-warning btn-sm">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                    </td>
                </tr>    
                @endforeach
            </x-table>
            @endif
        </x-card>
    </div>
</div>

@endsection
