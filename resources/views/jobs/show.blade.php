@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Jobs' => route('jobs.index'),
    'Job'
]" />
<x-page-title>{{ $job->name }}</x-page-title>
@endsection

@section('content')
<div class="row mb-3">

    <!-- Information -->
    <div class="col-md mb-3">
        <x-card>
            <x-slot name="title">
                <x-custom.indicator-active-status :toggle="$job->isActive()" />
            </x-slot>

            <x-slot name="options">
                @includeWhen($job->hasIncompleteWorkOrders(), 'work-orders.__.button-counter-incomplete', [
                    'class' => 'btn btn-outline-warning',
                    'counter' => $job->incomplete_work_orders_counter,
                    'parameters' => ['job' => $job->id],
                ])

                @includeWhen($job->hasWorkOrders(), 'work-orders.__.button-counter-all', [
                    'class' => 'btn btn-outline-primary',
                    'counter' => $job->work_orders_counter,
                    'parameters' => ['job' => $job->id],
                ])
                
                <a href="{{ route('jobs.edit', $job) }}" class="btn btn-warning">
                    <i class="bi bi-pencil-fill"></i>
                </a>
            </x-slot>

            <x-small-title title="Description">
                {{ $job->description }}
            </x-small-title>

            <x-small-title title="Success inspections required">
                {{ $job->success_inspections_required_count }}
            </x-small-title>

            <x-small-title title="Configuration of inspections to create">
                {{ $job->hasInspectionSetup() ? 'Yes' : 'No' }}
            </x-small-title>
        </x-card>
    </div>

    <!-- Products -->
    <div class="col-md">
        <x-card>
            <x-slot name="title">
                <span class="badge text-bg-dark">{{ $job->products_counter }}</span>
                <span class="align-middle">Products</span>
            </x-slot>             

            <x-slot name="options">
                @include('jobs.inc.modal-products')
            </x-slot>
            
            @if( $job->hasProducts() )
            <form action="{{ route('jobs.update.products', $job) }}" method="post" id="jobProductsDeleteForm">
                @method('patch')
                @csrf
                <x-table>
                    <x-slot name="thead">
                    <tr>
                        <td>Name</td>
                        <td>Category</td>
                        <td class="d-none"></td>
                    </tr>
                    </x-slot>
                    @foreach($job->products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td class="text-capitalize">{{ $product->category_name }}</td>
                        <td class="text-end d-none">
                            <input type="hidden" name="products[]" value="{{ $product->id }}">
                            <button class="btn btn-outline-danger btn-sm" type="button">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </x-table>
            </form>
            @endif
        </x-card>
    </div>
</div>

@push('scripts')
<script>
const jobProductsDeleteForm = {
    element: document.getElementById('jobProductsDeleteForm'),
    listen: function () {
        let self = this;

        if(! this.element ) {
            return false;
        }

        this.element.querySelectorAll('button.btn-outline-danger').forEach(function(button) {
            button.addEventListener('click', function (evt) {
                this.closest('tr').remove()
                self.element.submit()
            })
        })
    }
}
jobProductsDeleteForm.listen()
</script> 
@endpush
@endsection
