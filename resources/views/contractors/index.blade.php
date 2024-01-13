@extends('application')

@section('header')
<x-page-title>Contractors</x-page-title>
@endsection

@section('content')
<x-card>
    <x-slot name="options">
        <a href="{{ route('contractors.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i>
        </a>
    </x-slot>

    <x-table>
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
            <td class="text-center">
                <x-tooltip title="{{ ucfirst($contractor->presence_status) }}">
                    <x-indicator-on-off :toggle="$contractor->isAvailable()" />
                </x-tooltip>
            </td>
            <td>
                {{ $contractor->name }} - {{ $contractor->alias }}
            </td>
            <td>
                {{ $contractor->contact_name }}
            </td>
            <td>
                @include('contractors.__.contact-table-cell')
            </td>
            <td class="text-end">
                @if( $contractor->hasUnfinishedWorkOrders() )                  
                @include('work-orders.__.button-counter-unfinished', [
                    'counter' => $contractor->work_orders_unfinished_count,
                    'parameters' => ['contractor' => $contractor->id],
                ])
                @endif

                <a href="{{ route('contractors.show', $contractor) }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </x-table>
</x-card>
<br>

<div class="px-3">
    <x-pagination-simple-model :collection="$contractors" />
</div>
@endsection
