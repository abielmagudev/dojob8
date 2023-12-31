@extends('application')

@section('header')
@include('CpsProductMeasures/views/partials/header')
@endsection

@section('content')
@include('CpsProductMeasures/views/partials/subnavbar')
<x-card title="Exports">
    <form action="{{ route('extensions.store', [$extension, 'sub' => 'exports']) }}" method="post" autocomplete="off">
        @csrf
        <div class="mb-3">
            <label for="productSelect" class="form-label">Product</label>
            <select name="product" id="productSelect" class="form-select {{ bsInputInvalid( $errors->has('product') ) }}">
                <option label="All products"></option>
                @foreach($categories as $category)
                <optgroup label="{{ $category->name }}">
                    @foreach($category->products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </optgroup>
                @endforeach
            </select>
            <x-error name="product" />
        </div>
        <div class="mb-3">
            <label for="fromDate" class="form-label">From</label>
            <input type="date" name="from" id="fromDate" class="form-control {{ bsInputInvalid( $errors->has('from') ) }}">
            <x-error name="from" />
        </div>
        <div class="mb-3">
            <label for="toDate" class="form-label">To</label>
            <input type="date" name="to" id="toDate" class="form-control {{ bsInputInvalid( $errors->has('to') ) }}">
            <x-error name="to" />
        </div>
        <br>
        <div class="text-end">
            <button class="btn btn-success" type="submit">Export excel</button>
        </div>
    </form>
</x-card>
@endsection
