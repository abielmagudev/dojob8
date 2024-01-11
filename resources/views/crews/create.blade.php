@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Back to Crews' => route('crews.index'),
    'Create',
]" />
<x-page-title>Crews</x-page-title>
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

@push('scripts')
@include('crews._form.script-text-color-mode')
@endpush
@endsection
