@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Clients' => route('clients.index'),
    'Create'
]" />
<x-page-title>Clients</x-page-title>
@endsection

@section('content')
<x-card title="New client">
    <form action="{{ route('clients.store') }}" method="POST" autocomplete="off">
        @csrf
        @include('clients._form')
        <br>

        <div class="row align-items-center">
            <div class="col-md col-md-8 mb-3 mb-md-0">
            </div>
            <div class="col-md text-end">
                <a href="{{ route('clients.index') }}" class="btn btn-outline-primary">Cancel</a>
                <button class="btn btn-success" type="submit" name="redirect" value="{{ request('redirect', 'clients') }}">Create client</button>
            </div>
        </div>
    </form>
</x-card>
@endsection
