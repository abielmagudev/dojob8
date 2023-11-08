@extends('application')
<x-header subheader="Extension configuration">{{ $extension->name }}</x-header>
@section('content')
@include('CpsProductMeasures/views/partials/submenu')
<x-card title="Categories">
    <x-slot name="options">
        <a href="{{ route('extensions.create', [$extension, 'concept' => 'category']) }}" class="btn btn-primary">
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
                <a href="{{ route('extensions.edit', [$extension, 'concept' => 'category', 'category' => $category->id]) }}" class="btn btn-outline-warning">
                    <i class="bi bi-pencil-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach

    </x-table>
</x-card>
@endsection
