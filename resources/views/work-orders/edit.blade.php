@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Work orders' => route('work-orders.index'),
    sprintf(' %s ', $work_order->id) => route('work-orders.show', $work_order),
    'Edit',
]" />
<x-page-title>
    Work order #{{ $work_order->id }}

    @slot('subtitle')
    <div>
        <span>{{ $client->full_name }}</span>,
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
<x-card title="Edit work order">
    <form action="{{ route('work-orders.update', $work_order) }}" method="post">
        @method('patch')
        @include('work-orders._form')
        @include('work-orders._form.status')
        <br>

        <div class="text-end">
            <button class="btn btn-warning" type="submit">Update work order</button>
            <a href="{{ route('work-orders.index') }}" class="btn btn-primary">Back</a>
        </div>
    </form>
</x-card>
<br>

<x-custom.modal-confirm-delete :route="route('work-orders.destroy', $work_order)" concept="work order">
    <p>¿Do you want to continue to delete the work order <br> <b>#<?= $work_order->id ?> <?= $work_order->job->name ?></b>?</p>
</x-custom.modal-confirm-delete>

@if( $work_order->job->hasExtensions() )
@push('scripts') 
@include('work-orders.scripts.extensionsLoader')

<script>
extensionsLoader.get("<?= route('work-orders.ajax.edit', $work_order) ?>")
</script>

@endpush
@endif

@endsection
