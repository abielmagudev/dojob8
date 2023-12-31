@extends('application')

@section('header')
<x-header title="Clients" :breadcrumbs="[
    'Back to clients' => route('clients.index'),
    'Create' => null
]" />
@endsection

@section('content')
<x-card title="New client">
    <form action="{{ route('clients.store') }}" method="POST" autocomplete="off">
        @include('clients._form')
        <br>
        <div class="row align-items-center">
            <div class="col-md col-md-8 mb-3 mb-md-0">
                <div class="form-check">
                    <input class="form-check-input" id="afterSavingCheckbox" type="checkbox" role="checkbox" name="after_saving" value="1" checked>
                    <label class="form-check-label" for="afterSavingCheckbox">After saving the client, create a new order for this client.</label>
                </div>
            </div>
            <div class="col-md text-end">
                <button class="btn btn-success" type="submit" name="redirect" value="{{ request('redirect', 'clients') }}">Save client</button>
                <a href="{{ route('clients.index') }}" class="btn btn-primary">Cancel</a>
            </div>
        </div>
    </form>
</x-card>
@endsection
