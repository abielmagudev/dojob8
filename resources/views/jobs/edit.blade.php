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
        @include('jobs._form')
        <x-form-field-horizontal for="activeSwitch">
            <div class="alert alert-warning">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="activeSwitch" name="active" value="1" {{ isChecked( $job->isActive() ) }}>
                    <label class="form-check-label" for="activeSwitch">
                        <b>Active.</b>
                        <small>If you deactivate this option, you will not be able to use this job in new orders.</small>
                    </label>
                </div> 
            </div>
            <x-form-feedback error="active" />
        </x-form-field-horizontal>
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
