@extends('application')

@section('header')
<x-header title="{{ $extension->name }}" :breadcrumbs="[
    'Back to extensions' => route('extensions.index'),
    'Categories' => route('extensions.show', [$extension, 'sub' => 'category']),
    'Edit' => '#!',
]" />
@endsection

@section('content')
<x-card title="Edit category">
    <form action="{{ route('extensions.update', [$extension, 'sub' => 'category', 'category' => $category->id]) }}" method="post" autocomplete="off">
        @include('CpsProductMeasures/views/categories/_form')
        @method('put')
        <br>

        <div class="text-end">
            <button class="btn btn-warning" type="submit">Update category</button>
            <a href="{{ route('extensions.show', [$extension, 'sub' => 'category']) }}" class="btn btn-primary">Back</a>
        </div>
    </form>
</x-card>
@endsection
