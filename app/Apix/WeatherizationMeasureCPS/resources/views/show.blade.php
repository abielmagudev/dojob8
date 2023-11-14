@extends('application')

@section('header')
<x-header title="{{ $extension->name }}" :breadcrumbs="[
    'Back to extensions' => route('extensions.index'),
    'Configuration' => '#!',
]" />
@endsection

@section('content')
<x-card title="Product measures">
    <x-slot name="options">
        <a href="{{ route('extensions.create', $extension) }}" class="btn btn-primary">
            <b>+</b>
        </a>
    </x-slot>

    <x-table>
        <x-slot name="thead">
            <tr>
                <th class="text-nowrap">Item price ID</th>
                <th class="text-nowrap">Product or service name</th>
                <th class="text-nowrap">Material price</th>
                <th class="text-nowrap">Labor price</th>
                <th class="text-nowrap">Total cost</th>
                <th class="text-nowrap">Available</th>
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
            <td>{{ $measure->isAvailable() ? 'Yes' : 'No' }}</td>
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
