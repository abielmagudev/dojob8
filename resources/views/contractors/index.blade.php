@extends('application')

@section('header')
<x-header title="Contractors" />
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
                <th class="text-nowrap">Contact</th>
                <th></th>
            </tr>
        </x-slot>
        @foreach($contractors as $contractor)
        <tr>
            <td>
                <span data-bs-toggle="tooltip" data-bs-title="{{ ucfirst($contractor->status) }}">
                    <x-circle-off-on :switcher="$contractor->isAvailable()" />
                </span>
            </td>
            <td>
                {{ $contractor->name }} ({{ $contractor->alias }})
            </td>
            <td>
                @include('contractors.__.contact-table-cell')
            </td>
            <td class="text-end">
                @if( $contractor->hasUnfinishedWorkOrders() )                  
                <x-tooltip title="Unfinished work orders">
                    <a href="{{ $contractor->getUrlUnfinishedWorkOrders() }}" class="btn btn-warning">{{ $contractor->work_orders_unfinished_count }}</a>
                </x-tooltip>
                @endif
                
                @if( $contractor->hasWorkOrders() )
                <x-tooltip title="Work orders">
                    <a href="{{ $contractor->getUrlWorkOrdersFilteredBySelf() }}" class="btn btn-primary">{{ $contractor->work_orders->count() }}</a>
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

<x-pagination-simple-eloquent :collection="$contractors" />
@endsection
