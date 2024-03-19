@extends('application')

@section('header')
<x-page-title>Assessments</x-page-title>
@endsection

@section('content')
<x-card title="New assessment">
    <form action="{{ route('assessments.store') }}" method="post" autocomplete="off">
        @csrf
        @include('assessments.inc.form')
        <br>

        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('assessments.index') }}" class="btn btn-dark">Cancel</a>
            <button type="submit" class="btn btn-success">Create assessment</button>
        </div>
    </form>
</x-card>
@endsection
