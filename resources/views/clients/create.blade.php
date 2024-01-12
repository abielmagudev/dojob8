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
        @include('clients._form')
        <br>
        
        <div class="alert alert-warning">
            <div class="form-check">
                <input class="form-check-input" id="afterSavingCheckbox" type="checkbox" role="checkbox" name="after_saving" value="1" checked>
                <label class="form-check-label" for="afterSavingCheckbox">After saving the new client, create a work order for this client.</label>
            </div>
        </div>
        <br>

        <div class="row align-items-center">
            <div class="col-md col-md-8 mb-3 mb-md-0">
            </div>
            <div class="col-md text-end">
                <button class="btn btn-success" type="submit" name="redirect" value="{{ request('redirect', 'clients') }}">Create client</button>
                <a href="{{ route('clients.index') }}" class="btn btn-primary">Cancel</a>
            </div>
        </div>
    </form>
</x-card>
@endsection
