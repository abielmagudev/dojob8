@extends('application')

@section('header')
<x-header title="Jobs" :breadcrumbs="[
    'Back to jobs' => route('jobs.index'),
    $job->name => route('jobs.show', $job),
    'Edit' => null,
]">Jobs</x-header>
@endsection

@section('content')
<x-card title="Edit job">
    <form action="{{ route('jobs.update', $job) }}" method="post" autocomplete="off">
        @method('put')
        @include('jobs._form')
        <br>
        <div class="text-end">
            <button type="submit" class="btn btn-warning">Update job</button>
            <a href="{{ route('jobs.show', $job) }}" class="btn btn-primary">Back</a>
        </div>
    </form>
</x-card>
<br>

<x-custom.modal-confirm-delete :route="route('jobs.destroy', $job)" concept="job">
    <p>¿Do you want to continue to delete the job <br> <b><?= $job->name ?></b>?</p>
</x-custom.modal-confirm-delete>
@endsection
