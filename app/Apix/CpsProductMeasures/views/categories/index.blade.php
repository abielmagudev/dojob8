@extends('application')

@section('header')
@include('CpsProductMeasures/views/partials/header')
@endsection

@section('content')
@include('CpsProductMeasures/views/partials/subnavbar')
<x-card title="Categories">
    <x-slot name="options">
        <a href="{{ route('extensions.create', [$extension, 'sub' => 'category']) }}" class="btn btn-primary">
            <b>+</b>
        </a>
    </x-slot>

    <x-table>
        <x-slot name="thead">
            <tr>
                <th>Name</th>
                <th>Products</th>
                <th></th>
            </tr>
        </x-slot>

        @foreach($categories as $category)
        <tr class="align-middle">
            <td>{{ $category->name }}</td>
            <td>{{ $category->products_count }}</td>
            <td class="text-end">
                <a href="{{ route('extensions.edit', [$extension, 'sub' => 'category', 'category' => $category->id]) }}" class="btn btn-outline-warning">
                    <i class="bi bi-pencil-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach

    </x-table>
</x-card>
@endsection
