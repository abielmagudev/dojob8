@extends('application')
<x-header>Jobs</x-header>
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
                <th scope="col">Name</th>
                <th scope="col">Extensions</th>
                <th scope="col">Orders</th>
                <th></th>
            </tr>
        </x-slot>
        @foreach($jobs as $job)               
        <tr>
            <td>{{ $job->name }}</td>
            <td>{ $job->extensions_count }}</td>
            <td>{ $job->orders_count }}</td>
            <td class="text-nowrap text-end">
                <a href="{{ route('jobs.show', $job) }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-eye-fill"></i>
                </a>
                <a href="{{ route('jobs.edit', $job) }}" class="btn btn-outline-warning btn-sm">
                    <i class="bi bi-pencil-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </x-table>

</x-card>
@endsection
