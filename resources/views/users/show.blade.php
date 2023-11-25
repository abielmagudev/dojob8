@extends('application')

@section('header')
<x-header title="{{ $user->name }}" :breadcrumbs="[
    'Back to users' => route('users.index'),
    'User' => null
]">
    <x-slot name="options">
        <x-paginate 
            :previous="$routes['previous']" 
            :next="$routes['next']" 
        />
    </x-slot>
</x-header>
@endsection

@section('content')
<div class="row">
    <div class="col-md col-md-4">
        <x-card title="Information" class="h-100">
            <x-slot name="options">
                <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">
                    <i class="bi bi-pencil-fill"></i>
                </a>
            </x-slot>

            <p>
                @if( mt_rand(0,1) )
                <x-badge color="success" class="text-uppercase">Active</x-badge>
                
                @else
                <x-badge color="secondary" class="text-uppercase">Inactive</x-badge>

                @endif
            </p>

            <x-custom.p-label label="Email">
                {{ $user->email }}
            </x-custom.p-label>

            <x-custom.p-label label="Profile">
                {{ mt_rand(0,1) ? 'Staff ' : 'Intermediary' }}
            </x-custom.p-label>

            <x-custom.p-label label="Role">
                {{ mt_rand(0,1) ? 'Administrator' : 'Operator' }}
            </x-custom.p-label>

            <x-custom.p-label label="Last session">
                <span class="d-block">{{ now() }}</span>
                <span class="d-block">127.0.0.1</span>
            </x-custom.p-label>
        </x-card>    
    </div>

    <div class="col-md">
        <x-card title="Activities" class="h-100">
            <ul class="list-group list-group-flush">
                @foreach($user->activities as $activity)
                <li class="list-group-item">
                    <div class="mb-2">
                        {!! $activity->description !!}
                        <small class="d-block">{{ $activity->created_at }} by {{ $activity->user->name }}</small>             
                    </div>

                    @if( $activity->hasLink() )
                    <small>
                        <a href="{{ $activity->link }}" >See changes</a>
                    </small>
                    @endif
                </li>
                @endforeach
              </ul>
        </x-card>
    </div>

    <div class="col-md">
        <x-card title="Changes" class="h-100">
            <ul class="list-group list-group-flush">
                @foreach($user->changes->load('user') as $change)
                <li class="list-group-item">
                    <div class="mb-1">
                        {!! $change->description !!}          
                        <small class="d-block">{{ $change->created_at }} by {{ $change->user->name }}</small>
                    </div>

                    @if( $change->hasLink() )
                    <small>
                        <a href="{{ $change->link }}" >See changes</a>
                    </small>
                    @endif     
                </li>
                @endforeach
            </ul>
        </x-card>
    </div>
</div>
@endsection
