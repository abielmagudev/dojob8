@extends('application')
@section('content')
<x-card title="New order">
    <form action="{{ route('orders.store') }}" method="post">
        @include('orders._form')
        <input type="hidden" name="client" value="{{ $client->id }}">
        <div class="alert alert-warning">
            <label for="selectAfterSaving" class="form-labeo">After saving</label>
            <select id="selectAfterSaving" class="form-select" name="after_saving">
                <option value="1">Create a new order for this client</option>
                <option value="0">Just save order and finish</option>
            </select>
        </div>
        <br>
        <div class="text-end">
            <button class="btn btn-success" type="submit">Save order</button>
            <a href="{{ route('orders.index') }}" class="btn btn-primary">Cancel</a>
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
