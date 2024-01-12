@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Back to Work orders' => route('work-orders.index'),
    'Create',
]" />
<x-page-title>Work orders</x-page-title>
@endsection

@section('content')
<div class="row">
    <div class="col-sm">
        <x-card title="New work order">
            <form action="{{ route('work-orders.store') }}" method="post">
                @include('work-orders._form')
                <br>
                <div class="row justify-content-between">
                    <div class="col-md">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="afterSavingCheckbox" name="after_saving" value="1" checked>
                            <label class="form-check-label" for="afterSavingCheckbox">After saving, create a new work order for this client again.</label>
                        </div>
                    </div>
                    <div class="col-md text-end">
                        <button class="btn btn-success" type="submit">Save work order</button>
                        <a href="{{ route('work-orders.index') }}" class="btn btn-primary">Cancel</a>
                    </div>
                </div>
            </form>
        </x-card>
    </div>

    <div class="col-sm col-sm-3">
        <x-card title="Client" class="h-100">
            @include('clients.__.address')
            <br>
            {{ $client->contact_data->filter()->implode(', ') }}
        </x-card>
    </div>
</div>


@push('scripts') 
@include('work-orders.scripts.extensionsLoader')
@include('work-orders.scripts.selectedJob')

<script>
selectedJob.listen("<?= route('work-orders.ajax.create', '?') ?>")
</script>

@if( old('job') &&! $errors->has('job') )
<script>
extensionsLoader.get("<?= route('work-orders.ajax.create', old('job')) ?>")
</script>
@endif

@endpush
@endsection
