@extends('application')
<x-header subheader="Categories">{{ $extension->name }}</x-header>
@section('content')
<x-card title="Edit category">
    <form action="{{ route('extensions.update', [$extension, 'concept' => 'category', 'category' => $category->id]) }}" method="post" autocomplete="off">
        @include('CpsProductMeasures/views/categories/_form')
        @method('put')
        <br>

        <div class="text-end">
            <button class="btn btn-warning" type="submit">Update category</button>
            <a href="{{ route('extensions.show', [$extension, 'concept' => 'category']) }}" class="btn btn-primary">Back</a>
        </div>
    </form>
</x-card>
@endsection
