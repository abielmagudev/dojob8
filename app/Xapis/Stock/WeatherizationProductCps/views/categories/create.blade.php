@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Extensions' => route('extensions.index'),
    'Categories' => route('extensions.show', [$extension, 'sub' => 'categories']),
    'Create',
]" />
<x-page-title>{{ $extension->name }}</x-page-title>
@endsection

@section('content')
<x-card title="New category">
    <form action="{{ route('extensions.store', [$extension, 'sub' => 'categories']) }}" method="post" autocomplete="off">
        @csrf
        @include('WeatherizationProductCps/views/categories/_form')
        <input type="hidden" name="about" value="category">
        <br>

        <div class="text-end">
            <a href="{{ route('extensions.show', [$extension, 'sub' => 'categories']) }}" class="btn btn-outline-primary">Cancel</a>
            <button class="btn btn-success" type="submit">Create category</button>
        </div>
    </form>
</x-card>
@endsection
