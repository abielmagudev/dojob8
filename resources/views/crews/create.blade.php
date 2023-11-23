@extends('application')

@section('header')
<x-header title="Crews" :breadcrumbs="[
    'Back to crews' => route('crews.index'),
    'Create' => null,
]" />
@endsection

@section('content')
<x-card title="New crew">
    <form action="{{ route('crews.store') }}" method="post" autocomplete="off">
        @include('crews._form')
        <br>
        <div class="text-end">
            <button class="btn btn-success" type="submit">Save crew</button>
            <a href="{{ route('crews.index') }}" class="btn btn-primary">Cancel</a>
        </div>
    </form>
</x-card>
@endsection
