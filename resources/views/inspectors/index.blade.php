@extends('application')

@section('header')
<x-page-title>Inspectors</x-page-title>
@endsection

@section('content')
<x-card>
    <x-slot name="options">
    <a href="{{ route('inspectors.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i>
    </a>
    </x-slot>

    <x-table class="align-middle">
        <x-slot name="thead">
            <tr>
                <th>Name</th>
                <th>Notes</th>
                <th></th>
            </tr>
        </x-slot>
    
        @foreach($inspectors as $inspector)
        <tr>
            <td>{{ $inspector->name }}</td>
            <td>{{ $inspector->notes }}</td>
            <td class="text-end">
                @if( $inspector->hasPendingOrOnHoldInspections() )
                <x-tooltip title="Pending & on hold inspections">
                    <a href="{{ inspectionUrlGenerator('pendingOrOnHold', ['inspector' => $inspector->id]) }}" class="btn btn-warning btn-sm">
                        {{ $inspector->pending_and_on_hold_inspections->count() }}
                    </a>
                </x-tooltip>
                @endif
                
                <a href="{{ route('inspectors.show', $inspector) }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </x-table>
</x-card>
<br>

<x-pagination-simple-model :collection="$inspectors" />
@endsection
