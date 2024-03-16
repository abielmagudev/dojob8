@extends('application')

@section('header')
<x-page-title>Categories</x-page-title>
@endsection

@section('content')
<x-card title="Edit category">
    <form action="{{ route('categories.update', $category) }}" method="post" autocomplete="off">
        @method('put')
        @csrf
        @include('categories.inc.form')
        <br>

        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('categories.index') }}" class="btn btn-dark">Back</a>
            <button type="submit" class="btn btn-warning">Update category</button>
        </div>
    </form>
</x-card>
@endsection
