@extends('application')

@section('header')
<x-header title="Orders" :breadcrumbs="[
    'Back to orders' => route('orders.index'),
    'Create' => null,
]" />
@endsection

@section('content')
<x-card title="New order">
    <form action="{{ route('orders.store') }}" method="post">
        @include('orders._form')
        <input type="hidden" name="client" value="{{ $client->id }}">
        <br>
        <div class="text-end">
            <div class="d-inline-block">
                <div class="dropdown">
                    <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span>Save order</span>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <button class="dropdown-item" type="submit" name="after_saving" value="1">
                                <span>...and create another order</span>
                            </button>
                        </li>
                        <li>
                            <button class="dropdown-item" type="submit" name="after_saving" value="0">
                                <span>...and finish</span>
                            </button>
                        </li>
                    </ul>
                </div>
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
