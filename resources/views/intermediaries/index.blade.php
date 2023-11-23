@extends('application')

@section('header')
<x-header title="Intermediaries" />
@endsection

@section('content')
<x-card>
    <x-slot name="options">
        <a href="{{ route('intermediaries.create') }}" class="btn btn-primary">
            <b>+</b>
        </a>
    </x-slot>

    <x-table class="align-middle">
        <x-slot name="thead">
            <tr>
                <th></th>
                <th>Name</th>
                <th>Contact</th>
                <th>Phone</th>
                <th>Mobile</th>
                <th>Email</th>
                <th></th>
            </tr>
        </x-slot>
        @foreach($intermediaries as $intermediary)
        <tr>
            <td>
                <span data-bs-toggle="tooltip" data-bs-title="{{ $intermediary->isAvailable() ? 'Available' : 'Unavailable' }}">
                    <x-custom.circle-off-on :switcher="$intermediary->isAvailable()" />
                </span>
            </td>
            <td>{{ $intermediary->name }} <em>({{ $intermediary->alias }})</em></td>
            <td>{{ $intermediary->contact }}</td>
            <td>{{ $intermediary->phone_number }}</td>
            <td>{{ $intermediary->mobile_number }}</td>
            <td>{{ $intermediary->email }}</td>
            <td class="text-end">
                <a href="{{ route('intermediaries.show', $intermediary) }}" class="btn btn-outline-primary">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </x-table>
</x-card>
<br>
<x-pagination-simple :collection="$intermediaries" />
@endsection
