@extends('application')
@section('content')
<h1>{{ $extension->title }}</h1>
<br>
<p class="text-end">
    <a href="{{ route('extensions.create', $extension) }}" class="btn btn-primary">Add measure</a>
</p>
<x-card title="Measures">
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
                @foreach($measures as $measure)
                <tr class="align-middle ">
                    <td style="width:1%">{{ $measure->item_price_id }}</td>
                    <td>{{ $measure->name }}</td>
                    <td>${{ $measure->material_price }}</td>
                    <td>${{ $measure->labor_price }}</td>
                    <td>${{ $measure->total_cost }}</td>
                    <td class="text-end">
                        <a href="{{ route('extensions.edit', [$extension, 'measure' => $measure->id]) }}" class="btn btn-outline-warning">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-card>
@endsection
