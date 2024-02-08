@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Inspections' => route('inspections.index'),
    'Edit'
    ]" />
<x-page-title>
    Inspection #{{ $inspection->id }}
    @slot('subtitle')
    <div>
        <a href="{{ route('work-orders.show', [$inspection->work_order, 'tab' => 'inspections']) }}" class="text-decoration-none">
            Work order #{{ $inspection->work_order->id }} - {{ $inspection->work_order->job->name }}
        </a>
    </div>
    @endslot
</x-page-title>
@endsection

@section('content')
<x-card title="Edit inspection">
    <form action="{{ route('inspections.update', $inspection) }}" method="post" autocomplete="off">
        @method('put')
        @csrf
        @include('inspections._form')
        <br>

        <div class="text-end">
            <a href="{{ $url_back }}" class="btn btn-outline-primary me-1">Back</a>
            <button class="btn btn-warning" type="submit">Update inspection</button>
        </div>
    </form>
</x-card>
<br>

<x-custom.modal-confirm-delete :route="route('inspections.destroy', $inspection)" concept="inspection">
    <p>¿Do you want to continue to delete <br> the inspection <b><?= $inspection->id ?></b> of <b>Order #{{ $inspection->order_id }}</b>?</p>
</x-custom.modal-confirm-delete>
@endsection
