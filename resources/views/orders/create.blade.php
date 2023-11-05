@extends('application')
@section('content')
<x-card title="New order">
    <form action="{{ route('orders.store') }}" method="post">
        @include('orders._form')
        <input type="hidden" name="client" value="{{ $client->id }}">
        <br>
        <div class="text-end">
            <div class="btn-group">
                <button type="submit" class="btn btn-success" name="after_saving" value="1">Save and create new order</button>
                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <button class="dropdown-item" type="submit" name="after_saving" value="0">Save and finish</button>
                    </li>
                </ul>
            </div>
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
