@extends('application')

@section('header')
<x-header title="Crews">
    <x-slot name="options">
        <a href="{{ route('members.index') }}" class="btn btn-primary">Staff</a>
    </x-slot>
</x-header>
@endsection

@section('content')
<x-card>
    <x-slot name="options">
        <a href="{{ route('crews.create') }}" class="btn btn-primary">
            <b>+</b>
        </a>
    </x-slot>

    <x-table class="align-middle">
        <x-slot name="thead">
            <tr>
                <th></th>
                <th>Name</th>
                <th>Description</th>
                <th>Members</th>
                <th></th>
            </tr>
        </x-slot>
        @foreach($crews as $crew)
        <tr>
            <td class="text-center" style="width:1%; font-size:1.25rem">
                @if(! $crew->isActive() )
                <span class="text-secondary" data-bs-toggle="tooltip" data-bs-title="Inactive">
                    <i class="bi bi-circle"></i>
                </span>

                @elseif(! $crew->hasColor() )
                <span class="text-dark" data-bs-toggle="tooltip" data-bs-title="No color">
                    <i class="bi bi-question-circle-fill"></i>
                </span>
                    
                @else
                <span style="color:{{ $crew->color }}" data-bs-toggle="tooltip" data-bs-title="Active">
                    <i class="bi bi-circle-fill"></i>
                </span>

                @endif
            </td>
            <td>{{ $crew->name }}</td>
            <td>{{ $crew->description }}</td>
            <td>
                {{ mt_rand(0,5) }}
            </td>
            <td class="text-end">
                <button class="btn btn-outline-primary" type="button">
                    <i class="bi bi-people-fill"></i>
                </button>
                <a href="{{ route('crews.show', $crew) }}" class="btn btn-outline-primary">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </td>
        </tr>        
        @endforeach
    </x-table>
</x-card>
@endsection
