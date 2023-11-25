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
    <div class="col-sm">
        <x-card title="Information" class="h-100">
            <x-slot name="options">
                <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">
                    <i class="bi bi-pencil-fill"></i>
                </a>
            </x-slot>

            <p>
                <small class="d-block text-secondary">Status</small>
                @if( mt_rand(0,1) )
                <span class="badge text-bg-success">Active</span>

                @else
                <span class="badge text-bg-secondary">Inactive</span>

                @endif
            </p>

            <p>
                <small class="d-block text-secondary">Email</small>
                <span>{{ $user->email }}</span>
            </p>

            <p>
                <small class="d-block text-secondary">Type</small>
                <span>{{ mt_rand(0,1) ? 'Staff ' : 'Intermediary' }}</span>
            </p>

            <p>
                <small class="d-block text-secondary">Role</small>
                <span>{{ mt_rand(0,1) ? 'Administrator' : 'Operator' }}</span>
            </p>

            <p>
                <small class="d-block text-secondary">Last session</small>
                <span class="d-block">{{ now() }}</span>
                <span>127.0.0.1</span>
            </p>
        </x-card>    
    </div>
    <div class="col-sm">
        <x-card title="Journal" class="h-100">
            <p>
                <span class="d-block">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit.</span>
                <small>{{ now() }}</small>
            </p>
            <p>
                <span class="d-block">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit.</span>
                <small>{{ now() }}</small>
            </p>
            <p>
                <span class="d-block">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit.</span>
                <small>{{ now() }}</small>
            </p>
            <p>
                <span class="d-block">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit.</span>
                <small>{{ now() }}</small>
            </p>
        </x-card>
    </div>
</div>
@endsection
