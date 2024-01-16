@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Inspectors' => route('inspectors.index'),
    'Create'
]" />
<x-page-title>Inspectors</x-page-title>
@endsection

@section('content')
<x-card title="New inspector">
    <form action="{{ route('inspectors.store') }}" method="post" autocomplete="off">
        @include('inspectors._form')
        <br>
        <div class="text-end">
            <button class="btn btn-success" type="submit">Create inspector</button>
            <a href="{{ route('inspectors.index') }}" class="btn btn-primary">Cancel</a>
        </div>
    </form>
</x-card>
@endsection
