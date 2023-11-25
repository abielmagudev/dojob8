@extends('application')

@section('header')
<x-header title="Jobs">
    <x-slot name="options">
        <a href="{{ route('extensions.index') }}" class="btn btn-primary">
            <span>Extensions</span>
        </a>
    </x-slot>
</x-header>
@endsection

@section('content')
<x-card>
    <x-slot name="options">
        <a href="{{ route('jobs.create') }}" class="btn btn-primary">
            <b>+</b>
        </a>
    </x-slot>
    <x-table class="align-middle">
        <x-slot name="thead">
            <tr>
                <th></th>
                <th>Name</th>
                <th>Extensions</th>
                <th>Orders</th>
                <th></th>
            </tr>
        </x-slot>
        @foreach($jobs as $job)               
        <tr>
            <td style="width:1%">
                <span data-bs-toggle="tooltip" data-bs-title="{{ ucfirst($job->available_status) }}">
                    <x-custom.circle-off-on :switcher="$job->isAvailable()" />
                </span>
            </td>
            <td>{{ $job->name }}</td>
            <td>{{ $job->extensions_count }}</td>
            <td>{{ $job->orders_count }}</td>
            <td class="text-nowrap text-end">
                <a href="{{ route('jobs.show', $job) }}" class="btn btn-outline-primary">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </x-table>
</x-card>
<br>
<x-pagination-simple-eloquent :collection="$jobs" />
@endsection
