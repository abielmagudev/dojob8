@extends('application')

@section('header')
<x-page-title>Inspectors</x-page-title>
@endsection

@section('content')
<x-card title="{{ $inspectors->total() }} inspectors">
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
                @if( $inspector->hasPendingInspections() )
                @include('inspections.__.button-counter-pending', [
                    'counter' => $inspector->pending_inspections->count(),
                    'parameters' => ['inspector' => $inspector->id],
                ])
                @endif

                @if( $inspector->hasOnHoldInspections() )
                @include('inspections.__.button-counter-on-hold', [
                    'counter' => $inspector->on_hold_inspections->count(),
                    'parameters' => ['inspector' => $inspector->id],
                ])
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

<div class="px-3">
    <x-pagination-simple-model :collection="$inspectors" />
</div>
@endsection
