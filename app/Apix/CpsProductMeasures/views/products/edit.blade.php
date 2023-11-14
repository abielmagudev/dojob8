@extends('application')

@section('header')
<x-header title="{{ $extension->name }}" :breadcrumbs="[
    'Back to extensions' => route('extensions.index'),
    'Products' => route('extensions.show', [$extension, 'sub' => 'product']),
    'Edit' => '#!',
]" />
@endsection

@section('content')
<x-card title="Edit product">
    <form action="{{ route('extensions.update', [$extension, 'sub' => 'product', 'product' => $product->id]) }}" method="post" autocomplete="off">
        @method('put')
        @include('CpsProductMeasures/views/products/_form')
        <div class="mb-3">
            <label for="" class="form-label">Available</label>
            <div class="form-control">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_available" value="1" id="radioIsAvailable" {{ isChecked( $product->isAvailable() ) }}>
                    <label class="form-check-label" for="radioIsAvailable">
                        Show as a product or service to add to an order
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_available" value="0" id="radioIsNotAvailable" {{ isChecked( !$product->isAvailable() ) }}>
                    <label class="form-check-label" for="radioIsNotAvailable">
                        Hide product or service to avoid being added to an order
                    </label>
                </div>
            </div>
        </div>
        <br>

        <div class="text-end">
            <button class="btn btn-warning" type="submit">Update product</button>
            <a href="{{ route('extensions.show', $extension) }}" class="btn btn-primary">Back</a>
        </div>
    </form>
</x-card>
<br>
{{-- <x-custom.modal-confirm-delete concept="product" route="{{ route('extensions.destroy', [$extension, 'measure' => $measure->id]) }}">
    <p>¿Are you sure to delete the measure <br><b>{{ $measure->name }}</b>?</p>
</x-custom.modal-confirm-delete> --}}
@endsection
