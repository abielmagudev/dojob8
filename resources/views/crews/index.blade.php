@extends('application')

@section('header')
<x-header title="Crews" />
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
            <td class="text-center" style="width:1%; font-size:1.2rem">
                @if(! $crew->isActive() )
                <x-tooltip title="Inactive">
                    <i class="bi bi-circle"></i>
                </x-tooltip>

                @elseif(! $crew->hasColor() )
                <x-tooltip title="Active without color">
                    <i class="bi bi-question-circle-fill"></i>
                </x-tooltip>
                    
                @else
                <x-tooltip title="Active">
                    <i class="bi bi-circle-fill" style="color:{{ $crew->color }}"></i>
                </x-tooltip>

                @endif
            </td>
            <td>{{ $crew->name }}</td>
            <td>{{ $crew->description }}</td>
            <td>
                @if( $crew->members->count() )
                <x-tooltip :title="$crew->members->pluck('full_name')->implode('<br>')" html>
                    <x-badge color="dark">{{ $crew->members->count() }}</x-badge>
                </x-tooltip> 
                @endif
            </td>
            <td class="text-end">
                @if( $crew->hasUnfinishedWorkOrders() )
                <x-tooltip title="Unfinished work orders">
                <a href="{{ $crew->getUrlUnfinishedWorkOrders() }}" class="btn btn-warning">{{ $crew->work_orders_unfinished_count }}</a>
                </x-tooltip>
                @endif

                <a href="{{ route('crews.show', $crew) }}" class="btn btn-outline-primary">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </td>
        </tr>        
        @endforeach

    </x-table>
</x-card>
@endsection
