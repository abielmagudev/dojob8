@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Extensions' => route('extensions.index'),
    'Products' => route('extensions.show', [$extension, 'sub' => 'products']),
    'Create',
]" />
<x-page-title>{{ $extension->name }}</x-page-title>
@endsection

@section('content')
<x-card title="New product">
    <form action="{{ route('extensions.store', [$extension, 'sub' => 'products']) }}" method="post" autocomplete="off">
        @csrf
        @include('WeatherizationCps/views/products/_form')
        <br>

        <div class="text-end">
            <a href="{{ route('extensions.show', [$extension, 'sub' => 'products']) }}" class="btn btn-outline-primary">Cancel</a>
            <button class="btn btn-success" type="submit">Create product</button>
        </div>
    </form>
</x-card>
@endsection
