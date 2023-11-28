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
                <th class="text-nowrap">Name & Alias</th>
                <th>Contact</th>
                <th class="text-nowrap">Work orders</th>
                <th></th>
            </tr>
        </x-slot>
        @foreach($intermediaries as $intermediary)
        <tr>
            <td>
                <span data-bs-toggle="tooltip" data-bs-title="{{ ucfirst($intermediary->status) }}">
                    <x-circle-off-on :switcher="$intermediary->isAvailable()" />
                </span>
            </td>
            <td>
                <span class="d-block">{{ $intermediary->name }}</span>
                <small>{{ $intermediary->alias }}</small>
            </td>
            <td>
                <span class="d-block">{{ $intermediary->contact }}</span>
                <small>{{ $intermediary->contact_data_collection->filter()->implode(', ') }}</small>
            </td>
            <td>{{ mt_rand(0,400) }}</td>
            <td class="text-end">
                @if( $pending_work_orders = mt_rand(0, 200) )
                <button class="btn btn-warning {{ $pending_work_orders > 10 ?: 'px-3' }}" type="button" data-bs-toggle="tooltip" data-bs-title="Pending work orders">{{ $pending_work_orders }}</button>
                @endif

                <a href="{{ route('intermediaries.show', $intermediary) }}" class="btn btn-outline-primary">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </x-table>
</x-card>
<br>

<x-pagination-simple-eloquent :collection="$intermediaries" />
@endsection
