@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Back to Extensions' => route('extensions.index'),
    'Configuration'
]" />
<x-page-title>{{ $extension->name }}</x-page-title>
@include('CpsProductMeasures/views/partials/subnavbar')
@endsection

@section('content')
<x-card title="Products">
    <x-slot name="options">
        <a href="{{ route('extensions.create', [$extension, 'sub' => 'products']) }}" class="btn btn-primary">
            <b>+</b>
        </a>
    </x-slot>

    <x-table>
        <x-slot name="thead">
            <tr>
                <th class="text-nowrap">Item price ID</th>
                <th class="text-nowrap">Product or service name</th>
                <th class="text-nowrap">Category</th>
                <th class="text-nowrap">Material price</th>
                <th class="text-nowrap">Labor price</th>
                <th class="text-nowrap">Unit price</th>
                <th></th>
            </tr>
        </x-slot>

        @foreach($products as $product)
        <tr class="align-middle ">
            <td style="width:1%">{{ $product->item_price_id }}</td>
            <td class="{{ $product->isAvailable() ? 'text-dark' : 'text-secondary' }}">{{ $product->name }}</td>
            <td>{{ $product->category->name }}</td>
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
</x-card>
@endsection
