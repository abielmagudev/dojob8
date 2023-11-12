@extends('application')
<x-header subheader="Categories">{{ $extension->name }}</x-header>
@section('content')
<x-card title="New category">
    <form action="{{ route('extensions.store', [$extension, 'sub' => 'category']) }}" method="post" autocomplete="off">
        @include('CpsProductMeasures/views/categories/_form')
        <input type="hidden" name="about" value="category">
        <br>

        <div class="text-end">
            <button class="btn btn-success" type="submit">Save category</button>
            <a href="{{ route('extensions.show', [$extension, 'sub' => 'category']) }}" class="btn btn-primary">Cancel</a>
        </div>
    </form>
</x-card>
@endsection
