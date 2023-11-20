@extends('application')

@section('header')
<x-header title="Inspectors" :breadcrumbs="[
    'Back to inspectors' => route('inspectors.index'),
    'Create' => null,
]" />
@endsection

@section('content')
<x-card title="New inspector">
    <form action="{{ route('inspectors.store') }}" method="post" autocomplete="off">
        @include('inspectors._form')
        <br>
        <div class="text-end">
            <button class="btn btn-success" type="submit">Save inspector</button>
            <a href="{{ route('inspectors.index') }}" class="btn btn-primary">Cancel</a>
        </div>
    </form>
</x-card>
@endsection
