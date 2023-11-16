@extends('application')

@section('header')
<x-header title="Intermediaries" :breadcrumbs="[
    'Back to intermediaries' => route('intermediaries.index'),
    'Create' => null
]" />
@endsection

@section('content')
<x-card title="New intermediary">
    <form action="{{ route('intermediaries.store') }}" method="post" autocomplete="off">
        @include('intermediaries._form')
        <br>
        <div class="text-end">
            <button type="submit" class="btn btn-success">Save intermediary</button>
            <a href="{{ route('intermediaries.index') }}" class="btn btn-primary">Cancel</a>
        </div>
    </form>
</x-card>
@endsection
