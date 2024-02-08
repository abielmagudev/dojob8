@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Jobs' => route('jobs.index'),
    $job->name => route('jobs.show', $job),
    'Edit'
]" />
<x-page-title>{{ $job->name }}</x-page-title>
@endsection

@section('content')
<x-card title="Edit job">
    <form action="{{ route('jobs.update', $job) }}" method="post" autocomplete="off">
        @method('put')
        @csrf
        @include('jobs._form')
        <x-form-field-horizontal>
            <x-custom.switch-active-status :toggle="$job->isActive()">
                <b class="d-block">Active.</b>
                <small>If you deactivate this option, you will not be able to use this job in new work orders.</small>
            </x-custom.switch-active-status>
            <x-form-feedback error="active" />
        </x-form-field-horizontal>
        <br>

        <div class="text-end">
            <a href="{{ route('jobs.show', $job) }}" class="btn btn-outline-primary">Back</a>
            <button type="submit" class="btn btn-warning">Update job</button>
        </div>
    </form>
</x-card>
<br>

<x-custom.modal-confirm-delete :route="route('jobs.destroy', $job)" concept="job">
    <p>¿Do you want to continue to delete the job <br> <b><?= $job->name ?></b>?</p>
</x-custom.modal-confirm-delete>
@endsection
