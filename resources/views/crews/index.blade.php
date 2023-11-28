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
                {{ mt_rand(0,5) }}
            </td>
            <td class="text-end">
                @if( $pending_work_orders = mt_rand(0, 200) )
                <x-tooltip title="Pending work orders">
                <a href="{{ route('work-orders.index', ['crew' => $crew->id]) }}" class="btn btn-warning">{{ $pending_work_orders }}</a>
                </x-tooltip>
                @endif

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
