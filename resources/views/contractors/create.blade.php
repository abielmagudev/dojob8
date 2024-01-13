@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Contractors' => route('contractors.index'),
    'Create'
]" />
<x-page-title>Contractors</x-page-title>
@endsection

@section('content')
<x-card title="New contractor">
    <form action="{{ route('contractors.store') }}" method="post" autocomplete="off">
        @include('contractors._form')
        <br>
        <div class="text-end">
            <button type="submit" class="btn btn-success">Create contractor</button>
            <a href="{{ route('contractors.index') }}" class="btn btn-primary">Cancel</a>
        </div>
    </form>
</x-card>
@endsection
