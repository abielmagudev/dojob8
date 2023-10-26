@extends('application')
@section('content')
<x-card title="New order">
    <form action="{{ route('orders.store') }}" method="post">
        @include('orders._form')
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
selectedJob.listen("<?= route('orders.api.create', '?') ?>")
</script>

@if( old('job') &&! $errors->has('job') )
<script>
extensionsLoader.get("<?= route('orders.api.create', old('job')) ?>")
</script>
@endif

@endpush
@endsection
