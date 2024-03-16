@extends('application')

@section('header')
<x-page-title>Categories</x-page-title>
@endsection

@section('content')
<x-card>
    <x-slot name="title">
        <span class="badge text-bg-dark">{{ $categories->count() }}</span>
    </x-slot>

    <x-slot name="options">
        <a href="{{ route('categories.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i>
        </a>
    </x-slot>

    @if( $categories->count() )
    <x-table>
        <x-slot name="thead">
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Products</th>
                <th></th>
            </tr>
        </x-slot>

        @foreach($categories as $category)
        <tr>
            <td>{{ $category->name }}</td>
            <td>{{ $category->description }}</td>
            <td>{{ $category->products_count }}</td>
            <td class="text-nowrap text-end">
                <a href="{{ route('categories.show', $category) }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-eye-fill"></i>
                </a>
                <a href="{{ route('categories.edit', $category) }}" class="btn btn-outline-warning btn-sm">
                    <i class="bi bi-pencil-fill"></i>
                </a>
            </td>
        </tr> 
        @endforeach
    </x-table>
    @endif
</x-card>
@endsection
