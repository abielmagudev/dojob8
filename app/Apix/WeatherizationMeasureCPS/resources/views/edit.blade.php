@extends('application')
<x-header-sm>{{ $extension->title }}</x-header-sm>
@section('content')
<x-card title="Edit measure">
    <form action="{{ route('extensions.update', [$extension, 'measure' => $measure->id]) }}" method="post" autocomplete="off">
        @csrf
        @method('put')
        <div class="mb-3">
            <label for="numberItemPrice" class="form-label">Item</label>
            <input type="number" name="item_price_id" value="{{ old('item_price_id', $measure->item_price_id) }}" class="form-control" id="numberItemPrice" min="1" step="1" placeholder="Price ID...">
            <x-error name="item_price_id" />
        </div>
        <div class="mb-3">
            <label for="inputName" class="form-label">Name</label>
            <input type="text" name="name" value="{{ old('name', $measure->name) }}" class="form-control" id="inputName">
            <x-error name="name" />
        </div>
        <div class="mb-3">
            <label for="numberMaterialPrice" class="form-label">Material price</label>
            <input type="number" name="material_price" value="{{ old('materia_price', $measure->material_price) }}" class="form-control" id="numberMaterialPrice" min="0.01" max="999999.99" step="0.01">
            <x-error name="material_price" />
        </div>
        <div class="mb-3">
            <label for="numberLaborPrice" class="form-label">Labor price</label>
            <input type="number" name="labor_price" value="{{ old('labor_price', $measure->labor_price) }}" class="form-control" id="numberLaborPrice" min="0.01" max="999999.99" step="0.01">
            <x-error name="labor_price" />
        </div>
        <br>

        <div class="text-end">
            <button class="btn btn-warning" type="submit">Update measure</button>
            <a href="{{ route('extensions.show', $extension) }}" class="btn btn-primary">Cancel</a>
        </div>
    </form>
</x-card>
<br>
<x-custom.modal-confirm-delete concept="measure" route="{{ route('extensions.destroy', [$extension, 'measure' => $measure->id]) }}">
    <p>Are you sure to remove the measure <br><b>{{ $measure->name }}</b>?</p>
</x-custom.modal-confirm-delete>
@endsection
