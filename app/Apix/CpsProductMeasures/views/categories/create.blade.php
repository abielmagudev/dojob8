@extends('application')

@section('header')
<x-header title="{{ $extension->name }}" :breadcrumbs="[
    'Back to extensions' => route('extensions.index'),
    'Categories' => route('extensions.show', [$extension, 'sub' => 'categories']),
    'Create' => null,
]" />
@endsection

@section('content')
<x-card title="New category">
    <form action="{{ route('extensions.store', [$extension, 'sub' => 'categories']) }}" method="post" autocomplete="off">
        @include('CpsProductMeasures/views/categories/_form')
        <input type="hidden" name="about" value="category">
        <br>

        <div class="text-end">
            <button class="btn btn-success" type="submit">Save category</button>
            <a href="{{ route('extensions.show', [$extension, 'sub' => 'categories']) }}" class="btn btn-primary">Cancel</a>
        </div>
    </form>
</x-card>
@endsection
