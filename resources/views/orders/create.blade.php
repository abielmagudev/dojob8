@extends('application')

@section('header')
<x-header title="Work orders" :breadcrumbs="[
    'Back to work orders' => route('orders.index'),
    'Create' => null,
]" />
@endsection

@section('content')
<x-card title="New work order">
    <form action="{{ route('orders.store') }}" method="post">
        @include('orders._form')
        <input type="hidden" name="client" value="{{ $client->id }}">
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
                <a href="{{ route('orders.index') }}" class="btn btn-primary">Cancel</a>
            </div>
        </div>
    </form>
</x-card>

@push('scripts') 
@include('orders.scripts.extensionsLoader')
@include('orders.scripts.selectedJob')

<script>
selectedJob.listen("<?= route('orders.ajax.create', '?') ?>")
</script>

@if( old('job') &&! $errors->has('job') )
<script>
extensionsLoader.get("<?= route('orders.ajax.create', old('job')) ?>")
</script>
@endif

@endpush
@endsection
