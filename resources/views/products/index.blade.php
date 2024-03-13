@extends('application')

@section('header')
<x-page-title>Products</x-page-title>
@endsection

@section('content')
<x-card>
    <x-slot name="title">
        <div class="badge text-bg-dark">{{ $products->total() }}</div>
    </x-slot>

    <x-slot name="options">
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i>
        </a>
    </x-slot>

    @if( $products->isNotEmpty() )
    <x-table>
        <x-slot name="thead">
        <tr>
            <td>Name</td>
            <td>Description</td>
            <td>Item Price ID</td>
            <td>Material price</td>
            <td>Labor price</td>
            <td>Unit price</td>
            <td></td>
        </tr>
        </x-slot>

        @foreach($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->item_price_id }}</td>
            <td>
                <span class="currency-symbol">{{ $product->material_price_currency }}</span>
            </td>
            <td>
                <span class="currency-symbol">{{ $product->labor_price_currency }}</span>
            </td>
            <td>
                <span class="currency-symbol">{{ $product->unit_price_currency }}</span>
            </td>
            <td class="text-end">
                <a href="{{ route('products.show', $product) }}" class="btn btn-outline-primary btn-sm d-none">
                    <i class="bi bi-eye-fill"></i>
                </a>
                <a href="{{ route('products.edit', $product) }}" class="btn btn-outline-warning btn-sm">
                    <i class="bi bi-pencil-fill"></i>
                </a>
            </td>
        </tr> 
        @endforeach
    </x-table>
    @endif
</x-card>
<br>

<div class="px-3">
    <x-pagination-simple-model :collection="$products" />
</div>
@endsection
