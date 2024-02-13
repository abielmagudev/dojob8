@extends('application')
@section('header')

<x-breadcrumb :items="[
    'Work orders' => route('work-orders.index'),
    'Create',
]" />

<x-page-title>Work order</x-page-title>

@include('work-orders.__.summary-client')

@endsection

@section('content')
<x-card title="New work order">
    <form action="{{ route('work-orders.store') }}" method="post" autocomplete="off">
        @csrf
        @include('work-orders._form')
        <input type="hidden" name="client" value="{{ $client->id }}">  
        <x-form-field-horizontal>
            <div class="alert alert-warning">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="afterSavingCheckbox" name="after_saving" value="1" checked>
                    <label class="form-check-label" for="afterSavingCheckbox">After creating a work order, return to create a new work order for this client.</label>
                </div>
            </div>
        </x-form-field-horizontal>
        <br>

        <div class="text-end">
            <a href="{{ route('work-orders.index') }}" class="btn btn-outline-primary">Cancel</a>
            <button class="btn btn-success" type="submit">Create work order</button>
        </div>
    </form>

</x-card>
@endsection

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
