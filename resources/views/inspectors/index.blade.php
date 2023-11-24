@extends('application')

@section('header')
<x-header title="Inspectors">
    <x-slot name="options">
        <a href="{{ route('inspections.index') }}" class="btn btn-primary">Inspections</a>
    </x-slot>
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
