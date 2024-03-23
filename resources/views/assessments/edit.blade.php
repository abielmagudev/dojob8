@extends('application')

@section('header')
<x-page-title>Assessment #{{ $assessment->id }}</x-page-title>
@endsection

@section('content')
<x-card title="Edit assessment">
    <form action="{{ route('assessments.update', $assessment) }}" method="post" autocomplete="off">
        @method('put')
        @csrf
        @include('assessments.inc.form')

        <x-form-field-horizontal for="statusSelect" label="Status">
            <select name="status" id="statusSelect" class="form-select">
                @foreach($statuses as $status)
                <option value="{{ $status }}" {{ isSelected( $status == old('status', $assessment->status) ) }}>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
            <x-form-feedback error="status" />
        </x-form-field-horizontal>
        <br>

        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('assessments.index') }}" class="btn btn-dark">Cancel</a>
            <button type="submit" class="btn btn-warning">Update assessment</button>
        </div>
    </form>
</x-card>
<br>

<x-custom.modal-confirm-delete :route="route('assessments.destroy', $assessment)" concept="assessment">
    <p>¿Do you want to continue to delete <br> the assessment <b>#<?= $assessment->id ?></b>?</p>
</x-custom.modal-confirm-delete>
@endsection
