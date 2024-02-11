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
                <th></th>
                <th>Name</th>
                <th>Notes</th>
                <th></th>
            </tr>
        </x-slot>
        <tbody>
            @foreach($agencies as $agency)
            <tr>
                <td style="width:1%">
                    <x-custom.indicator-active-status :toggle="$agency->isActive()" tooltip />
                </td>
                <td class="text-nowrap pe-5" style="width:1%">
                    {{ $agency->name }}
                </td>
                <td>
                    {{ $agency->notes }}
                </td>
                <td class="text-end text-nowrap">
                    @includeWhen($agency->hasInspectionsWithPendingStatus(), 'inspections.__.button-counter-pending', [
                        'counter' => $agency->inspections_with_pending_status_counter,
                        'parameters' => ['agency' => $agency->id],
                    ])

                    @includeWhen($agency->hasInspectionsWithAwaitingStatus(), 'inspections.__.button-counter-awaiting', [
                        'counter' => $agency->inspections_with_awaiting_status_counter,
                        'parameters' => ['agency' => $agency->id],
                    ])

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
