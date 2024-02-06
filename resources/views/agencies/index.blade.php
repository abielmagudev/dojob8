@extends('application')
@section('header')
    <x-page-title>Agencies</x-page-title>
@endsection

@section('content')
<x-card>
    <x-slot name="options">
        <a href="{{ route('agencies.create') }}" class="btn btn-primary">
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
        <tbody>
            @foreach($agencies as $agency)
            <tr>
                <td>{{ $agency->name }}</td>
                <td>{{ $agency->notes }}</td>
                <td class="text-end">
                    <a href="{{ route('agencies.show', $agency) }}" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-eye-fill"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </x-table>
</x-card>
@endsection
