@extends('application')

@section('header')
<x-header title="Contractors" :breadcrumbs="[
    'Back to contractors' => route('contractors.index'),
    'Create' => null
]" />
@endsection

@section('content')
<x-card title="New contractor">
    <form action="{{ route('contractors.store') }}" method="post" autocomplete="off">
        @include('contractors._form')
        <br>
        <div class="text-end">
            <button type="submit" class="btn btn-success">Save contractor</button>
            <a href="{{ route('contractors.index') }}" class="btn btn-primary">Cancel</a>
        </div>
    </form>
</x-card>
@endsection
