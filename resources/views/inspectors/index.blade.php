@extends('application')

@section('header')
<x-header title="Inspectors">
    @slot('subtitle')
    <small class="align-middle badge text-bg-dark">{{ $inspectors->total() }}</small>
    @endslot
</x-header>
@endsection

@section('content')
<x-card>
    <x-slot name="options">
    <a href="{{ route('inspectors.create') }}" class="btn btn-primary">
        <b>+</b>
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
                @if( $inspector->hasInspectionsOnHold() )
                <x-tooltip title="Pending inspections">
                    <a href="{{ $inspector->url_pending_inspections }}" class="btn btn-warning">{{ $inspector->inspections_on_hold->count() }}</a>
                </x-tooltip>
                @endif
                
                @if( $inspector->hasInspections() )
                <x-tooltip title="Inspections">
                    <a href="{{ $inspector->url_own_inspections }}" class="btn btn-primary">{{ $inspector->inspections->count() }}</a>
                </x-tooltip>                   
                @endif
                
                <a href="{{ route('inspectors.show', $inspector) }}" class="btn btn-outline-primary">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </x-table>
</x-card>
<br>

<x-pagination-simple-eloquent :collection="$inspectors" />
@endsection
