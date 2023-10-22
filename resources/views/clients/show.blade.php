@extends('application')
@section('content')
<div class="row">

    {{-- Information --}}
    <div class="col-sm col-sm-4">
        <x-card title="Client">
            <x-slot name="options">
                <a href="{{ route('clients.edit', $client) }}" class="btn btn-warning">
                    <i class="bi bi-pencil-fill"></i>
                </a>
            </x-slot>
        
            <p>
                <small class="d-block text-secondary">Full name</small>
                {{ $client->fullname }}
            </p>
            <p>
                <small class="d-block text-secondary">Address</small>
                {{ $client->address }}
                <small class="d-block">{{ $client->location }}</small>
            </p>
            <p>
                <small class="d-block text-secondary">Zip code</small>
                {{ $client->zip_code }}
            </p>
            <p>
                <small class="d-block text-secondary">Contact</small>
                <span class="d-block">{{ $client->phone_number }}</span>
                <span class="d-block">{{ $client->mobile_number }}</span>
                <span class="d-block">{{ $client->email }}</span>
            </p>
            <p>
                <small class="d-block text-secondary">Notes</small>
                {{ $client->notes }}
            </p>
        </x-card>
    </div>

    {{-- Work Orders --}}
    <div class="col-sm">
        <x-card title="Work orders">
            <x-slot name="options">
                <a href="{{ route('orders.create', ['client' => $client->id]) }}" class="btn btn-success">
                    <b>+</b>
                </a>
            </x-slot>
        </x-card>
    </div>
</div>
@endsection
