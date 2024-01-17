@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Work orders' => route('work-orders.index'),
    'Create',
]" />
<x-page-title>
    {{ $client->full_name }}

    @slot('subtitle')
    <div>
        <span>{{ $client->address_data->only(['street', 'city_name', 'state_name', 'country_code'])->filter()->implode(', ') }}</span>,
        <span>ZIP {{ $client->zip_code }}</span>
        @if($client->hasDistrictCode())                
        <span>- DC {{ $client->district_code }}</span>
        @endif
    </div>
    <div>
        <x-custom.tooltip-contact-channels :channels="$client->contact_data->filter()" class="badge border" />
    </div>
    @endslot
</x-page-title>
@endsection

@section('content')
<x-card title="New work order">
    <form action="{{ route('work-orders.store') }}" method="post">
        @include('work-orders._form')
        <input type="hidden" name="client" value="{{ $client->id }}">  
        <x-form-field-horizontal>
            <div class="alert alert-warning">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="afterSavingCheckbox" name="after_saving" value="1" checked>
                    <label class="form-check-label" for="afterSavingCheckbox">Create a new work order again for this client, after it is created.</label>
                </div>
            </div>
        </x-form-field-horizontal>
        <br>

        <div class="text-end">
            <button class="btn btn-success" type="submit">Create work order</button>
            <a href="{{ route('work-orders.index') }}" class="btn btn-primary">Cancel</a>
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
