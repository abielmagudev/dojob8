@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Inspections' => route('inspections.index'),
    'Edit'
    ]" />
{{-- sprintf('#%s', $inspection->id) => route('inspections.show', $inspection), --}}
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
        @include('inspections._form')
        @method('put')
        <br>

        <div class="text-end">
            <button class="btn btn-warning" type="submit">Update inspection</button>
            <a href="{{ $url_back }}" class="btn btn-primary">Back</a>
        </div>
    </form>
</x-card>
<br>

<x-custom.modal-confirm-delete :route="route('inspections.destroy', $inspection)" concept="inspection">
    <p>¿Do you want to continue to delete <br> the inspection <b><?= $inspection->id ?></b> of <b>Order #{{ $inspection->order_id }}</b>?</p>
</x-custom.modal-confirm-delete>
@endsection
