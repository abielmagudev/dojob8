@extends('application')

@section('header')
<x-header title="Inspections">
    <x-slot name="options">
        <a href="{{ route('inspectors.index') }}" class="btn btn-primary">Inspectors</a>
    </x-slot>
</x-header>
@endsection

@section('content')
<x-card>
    <x-table class="align-middle">
        <x-slot name="thead">
            <tr>
                <th>Name</th>
                <th>Client</th>
                <th>Job</th>
                <th>Inspector</th>
                <th>Status</th>
                <th></th>
            </tr>
        </x-slot>
    
        @foreach($inspections as $inspection)
        <tr>
            <td class="text-nowrap ">{{ $inspection->scheduled_date->format('D d M, Y') }}</td>
            <td>{{ $inspection->order->client->address }}</td>
            <td>{{ $inspection->order->job->name }}</td>
            <td>{{ $inspection->inspector->name }}</td>
            <td style="max-width:128px">
                <x-badge color="{{ $inspection->status_color }}" class="text-uppercase w-100">{{ $inspection->status_label }}</x-badge>
            </td>
            <td class="text-end">
                <a href="{{ route('inspections.show', $inspection) }}" class="btn btn-outline-primary">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </x-table>
</x-card>
<br>
<x-pagination-simple-eloquent :collection="$inspections" />
@endsection
