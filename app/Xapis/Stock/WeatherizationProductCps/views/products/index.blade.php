@extends('application')

@section('header')
@include('WeatherizationProductCps.views.partials.header')
@include('WeatherizationProductCps/views/partials/subnavbar')
@endsection

@section('content')
<x-card title="{{ $products->count() }} Products">
    <x-slot name="options">
        <a href="{{ route('extensions.create', [$extension, 'sub' => 'products']) }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i>
        </a>
    </x-slot>

    @if( $products->count() ) 
    <x-table>
        <x-slot name="thead">
            <tr>
                <th class="text-nowrap">Product</th>
                <th class="text-nowrap">Category</th>
                <th class="text-nowrap">Item price ID</th>
                <th class="text-nowrap">Material price</th>
                <th class="text-nowrap">Labor price</th>
                <th class="text-nowrap">Unit price</th>
                <th></th>
            </tr>
        </x-slot>

        @foreach($products as $product)
        <tr class="align-middle ">
            <td>{{ $product->name }}</td>
            <td>{{ $product->hasCategory() ? $product->category->name : 'Without category' }}</td>
            <td>{{ $product->item_price_id }}</td>
            <td>${{ $product->material_price }}</td>
            <td>${{ $product->labor_price }}</td>
            <td>${{ $product->unit_price }}</td>
            <td class="text-end">
                <a href="{{ route('extensions.edit', [$extension, 'sub' => 'products', 'product' => $product->id]) }}" class="btn btn-outline-warning">
                    <i class="bi bi-pencil-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </x-table>
    @endif
</x-card>
@endsection
