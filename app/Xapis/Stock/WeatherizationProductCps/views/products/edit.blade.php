@extends('application')

@section('header')
<x-header title="{{ $extension->name }}" :breadcrumbs="[
    'Extensions' => route('extensions.index'),
    'Products' => route('extensions.show', [$extension, 'sub' => 'products']),
    'Edit' => null,
]" />
@endsection

@section('content')
<x-card title="Edit product">
    <form action="{{ route('extensions.update', [$extension, 'sub' => 'products', 'product' => $product->id]) }}" method="post" autocomplete="off">
        @csrf
        @method('put')
        @include('WeatherizationProductCps/views/products/_form')

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
            <a href="{{ route('extensions.show', $extension) }}" class="btn btn-outline-primary">Back</a>
            <button class="btn btn-warning" type="submit">Update product</button>
        </div>
    </form>
</x-card>
<br>
{{-- <x-custom.modal-confirm-delete concept="product" route="{{ route('extensions.destroy', [$extension, 'measure' => $measure->id]) }}">
    <p>¿Are you sure to delete the measure <br><b>{{ $measure->name }}</b>?</p>
</x-custom.modal-confirm-delete> --}}
@endsection
