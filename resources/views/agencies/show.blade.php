@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Agencies' => route('agencies.index'),
    'Agency'
]" />
<x-page-title>{{ $agency->name }}</x-page-title>
@endsection

@section('content')
<div class="row">
    <!-- Information -->
    <div class="col-sm">
        <x-card>
            <x-slot name="title">
                <x-custom.indicator-active-status :toggle="$agency->isActive()" />
            </x-slot>

            <x-slot name="options">
                @includeWhen($agency->hasInspectionsWithPendingAttributes(), 'inspections.__.button-counter-pending', [
                    'class' => 'btn btn-outline-warning btn-sm',
                    'counter' => $agency->inspections_with_pending_attributes_counter,
                    'parameters' => ['agency' => $agency->id],
                ])

                @includeWhen($agency->hasInspectionsWithAwaitingStatus(), 'inspections.__.button-counter-awaiting', [
                    'class' => 'btn btn-outline-primary btn-sm',
                    'counter' => $agency->inspections_with_awaiting_status_counter,
                    'parameters' => ['agency' => $agency->id],
                ])

                <a href="{{ route('agencies.edit', $agency) }}" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil-fill"></i>
                </a>
            </x-slot>
            <x-small-title title="Notes">
                {{ $agency->notes }}
            </x-small-title>

            <x-custom.information-hook-users :model="$agency" />
        </x-card>
    </div>

    <!-- Accounts -->
    @can('create-users')  
    <div class="col-sm">
        <x-card title="Accounts" class="h-100">
            <x-slot name="options">
                <a href="{{ route('users.create', ['agency' => $agency->id]) }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg"></i>
                </a>
            </x-slot>

            @if( $agency->hasUsers() )
            <x-table class="align-middle">
                <x-slot name="thead">
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th></th>
                </tr>
                </x-slot>
                @foreach($agency->users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="text-end">
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-warning btn-sm">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </x-table>
            @endif
        </x-card>
    </div>
    @endcan
</div>
    
@endsection
