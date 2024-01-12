@extends('application')

@section('header')
<x-page-title>Contractors</x-page-title>
@endsection

@section('content')
<x-card>
    <x-slot name="options">
        <a href="{{ route('contractors.create') }}" class="btn btn-primary">
            <b>+</b>
        </a>
    </x-slot>

    <x-table class="align-middle">
        <x-slot name="thead">
            <tr>
                <th></th>
                <th class="text-nowrap">Name (Alias)</th>
                <th>Contact</th>
                <th></th>
                <th></th>
            </tr>
        </x-slot>
        @foreach($contractors as $contractor)
        <tr>
            <td>
                <x-tooltip title="{{ ucfirst($contractor->status) }}">
                    <x-indicator-on-off :toggle="$contractor->isAvailable()" />
                </x-tooltip>
            </td>
            <td>
                {{ $contractor->name }} ({{ $contractor->alias }})
            </td>
            <td>
                {{ $contractor->contact_name }}
            </td>
            <td>
                @include('contractors.__.contact-table-cell')
            </td>
            <td class="text-end">
                @if( $contractor->hasUnfinishedWorkOrders() )                  
                <x-tooltip title="Unfinished work orders">
                    <a href="{{ \App\Models\WorkOrder\WorkOrderUrlGenerator::unfinished(['contractor' => $contractor->id]) }}" class="btn btn-warning">{{ $contractor->work_orders_unfinished_count }}</a>
                </x-tooltip>
                @endif
                
                @if( $contractor->hasWorkOrders() )
                <x-tooltip title="Work orders">
                    <a href="{{ \App\Models\WorkOrder\WorkOrderUrlGenerator::all(['contractor' => $contractor->id]) }}" class="btn btn-primary">{{ $contractor->work_orders->count() }}</a>
                </x-tooltip>
                @endif

                <a href="{{ route('contractors.show', $contractor) }}" class="btn btn-outline-primary">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </x-table>
</x-card>
<br>

<x-pagination-simple-model :collection="$contractors" />
@endsection
