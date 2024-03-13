@extends('application')

@section('header')
<x-page-title>Products</x-page-title>
@endsection

@section('content')
<x-card title="New product">
    <form action="{{ route('products.store') }}" method="post" autocomplete="off">
        @csrf
        @include('products.inc.form')
        <br>
        
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('products.index') }}" class="btn btn-dark">Cancel</a>
            <button type="submit" class="btn btn-success">Create product</button>
        </div>
    </form>
</x-card>
@endsection
