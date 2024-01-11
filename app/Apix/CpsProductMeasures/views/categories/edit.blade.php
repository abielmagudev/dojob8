@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Back to Extensions' => route('extensions.index'),
    'Categories' => route('extensions.show', [$extension, 'sub' => 'categories']),
    'Edit',
]" />
<x-page-title>{{ $extension->name }}</x-page-title>
@endsection

@section('content')
<x-card title="Edit category">
    <form action="{{ route('extensions.update', [$extension, 'sub' => 'categories', 'category' => $category->id]) }}" method="post" autocomplete="off">
        @include('CpsProductMeasures/views/categories/_form')
        @method('put')
        <br>

        <div class="text-end">
            <button class="btn btn-warning" type="submit">Update category</button>
            <a href="{{ route('extensions.show', [$extension, 'sub' => 'categories']) }}" class="btn btn-primary">Back</a>
        </div>
    </form>
</x-card>
@endsection
