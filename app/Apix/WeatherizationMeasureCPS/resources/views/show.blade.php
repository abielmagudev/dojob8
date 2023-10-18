@extends('application')
<x-header>{{ $extension->title }}</x-header>
@section('content')
<x-card title="Measures">
    <x-slot name="options">
        <a href="{{ route('extensions.create', $extension) }}" class="btn btn-primary">
            <b>+</b>
        </a>
    </x-slot>

    <x-table>
        <x-slot name="thead">
            <tr>
                <th>Item</th>
                <th>Name</th>
                <th>Material price</th>
                <th>Labor price</th>
                <th>Total cost</th>
                <th></th>
            </tr>
        </x-slot>

        @foreach($measures as $measure)
        <tr class="align-middle ">
            <td style="width:1%">{{ $measure->item_price_id }}</td>
            <td>{{ $measure->name }}</td>
            <td>${{ $measure->material_price }}</td>
            <td>${{ $measure->labor_price }}</td>
            <td>${{ $measure->total_cost }}</td>
            <td class="text-end">
                <a href="{{ route('extensions.edit', [$extension, 'measure' => $measure->id]) }}" class="btn btn-outline-warning">
                    <i class="bi bi-pencil-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </x-table>
</x-card>
@endsection
