@extends('application')
@section('content')
<h1>{{ $extension->title }}</h1>
<br>
<p class="text-end">
    <a href="{{ route('extensions.create', $extension) }}" class="btn btn-primary">Add product</a>
</p>
<x-card title="Products">
    <div class="table-responsive">
        <table class="table">
            <tbody>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Name</th>
                        <th>Material price</th>
                        <th>Labor price</th>
                        <th>Total cost</th>
                        <th></th>
                    </tr>
                </thead>
                @foreach($products as $product)
                <tr class="align-middle ">
                    <td style="width:1%">{{ $product->item_price_id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>${{ $product->material_price }}</td>
                    <td>${{ $product->labor_price }}</td>
                    <td>${{ $product->total_cost }}</td>
                    <td class="text-end">
                        <a href="{{ route('extensions.edit', [$extension, 'product' => $product->id]) }}" class="btn btn-outline-warning">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-card>
@endsection
