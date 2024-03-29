@extends('application')

@section('header')
<x-page-title>Contractors</x-page-title>
@endsection

@section('content')
<x-card title="{{ $contractors->count() }}">
    <x-slot name="options">
        <a href="{{ route('contractors.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i>
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
            <td class="text-center">
                <x-custom.indicator-active-status :toggle="$contractor->isActive()" tooltip />
            </td>
            <td class="text-nowrap">{{ $contractor->name }} ({{ $contractor->alias }})</td>
            <td class="text-nowrap">{{ $contractor->contact_name }}</td>
            <td class="text-nowrap">
                <x-custom.information-contact-channels :channels="$contractor->contact_data->filter()" type="tooltip" item-class="d-inline-block small mx-2" />
            </td>
            <td class="text-nowrap text-end">
                @includeWhen($contractor->HasIncompleteWorkOrders(), 'work-orders.__.button-counter-incomplete', [
                    'counter' => $contractor->incomplete_work_orders_count,
                    'parameters' => ['contractor' => $contractor->id],
                ])

                <a href="{{ route('contractors.show', $contractor) }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </x-table>
</x-card>
<br>

@endsection
