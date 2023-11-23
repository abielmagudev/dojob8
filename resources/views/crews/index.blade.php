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

    <div class="d-flex justify-content-center mb-4">
        <div>
            <span class="text-secondary">
                <i class="bi bi-circle"></i>
            </span>
            <span>Inactive</span>
        </div>
        <div class="mx-3">
            <span class="text-dark">
                <i class="bi bi-question-circle-fill"></i>
            </span>
            <span>Colorless</span>
        </div>
        <div>
            <span class="text-dark">
                <i class="bi bi-circle-fill"></i>
            </span>
            <span>Colored</span>
        </div>
    </div>

    <x-table class="align-middle ">
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
                <span class="text-secondary">
                    <i class="bi bi-circle"></i>
                </span>

                @elseif(! $crew->hasColor() )
                <span class="text-dark">
                    <i class="bi bi-question-circle-fill"></i>
                </span>
                    
                @else
                <span style="color:{{ $crew->color }}">
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
                    <i class="bi bi-people"></i>
                </button>
                <a href="{{ route('crews.edit', $crew) }}" class="btn btn-outline-warning">
                    <i class="bi bi-pencil-fill"></i>
                </a>
            </td>
        </tr>        
        @endforeach
    </x-table>
</x-card>
@endsection
