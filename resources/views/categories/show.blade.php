@extends('application')

@section('header')
<x-page-title subtitle="Category">{{ $category->name }}</x-page-title>
@endsection

@section('content')
<x-card>
    <x-slot name="title">
        <span class="badge text-bg-dark">{{ $category->products_counter }}</span>
        <span class="align-middle">Products</span>
    </x-slot>

    @if( $category->hasProducts() )
    <x-table>
        <x-slot name="thead">
        <tr>
            <th>Name</th>
            <th>Description</th>
        </tr>
        </x-slot>

        @foreach($category->products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->description }}</td>
        </tr>
        @endforeach
    </x-table>
    @endif
</x-card>
@endsection
