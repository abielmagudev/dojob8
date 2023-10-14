@extends('application')
@section('content')
<h1>{{ $extension->title }}</h1>
<br>
<x-card title="Add product">
    <form action="{{ route('extensions.update', [$extension, 'product' => $product->id]) }}" method="post">
        @csrf
        @method('put')
        <div class="mb-3">
            <label for="numberItemPrice" class="form-label">Item</label>
            <input type="number" name="item_price_id" value="{{ old('item_price_id', $product->item_price_id) }}" class="form-control" id="numberItemPrice" min="1" step="1" placeholder="Price ID...">
        </div>
        <div class="mb-3">
            <label for="inputName" class="form-label">Name</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control" id="inputName">
        </div>
        <div class="mb-3">
            <label for="numberMaterialPrice" class="form-label">Material price</label>
            <input type="number" name="material_price" value="{{ old('materia_price', $product->material_price) }}" class="form-control" id="numberMaterialPrice" min="0.01" step="0.01">
        </div>
        <div class="mb-3">
            <label for="numberLaborPrice" class="form-label">Labor price</label>
            <input type="number" name="labor_price" value="{{ old('labor_price', $product->labor_price) }}" class="form-control" id="numberLaborPrice" min="0.01" step="0.01">
        </div>
        <br>

        <div class="text-end">
            <button class="btn btn-warning" type="submit">Update product</button>
            <a href="{{ route('extensions.show', $extension) }}" class="btn btn-dark">Cancel</a>
        </div>
    </form>
</x-card>
<br>
<form action="{{ route('extensions.destroy', [$extension, 'product' => $product->id]) }}" method="post">
    @csrf
    @method('delete')
    <div class="text-end">
        <button class="btn btn-outline-danger" type="submit">Delete product</button>
    </div>
</form>
@endsection
