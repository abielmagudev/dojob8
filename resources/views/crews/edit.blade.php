@extends('application')

@section('header')
<x-header title="Crews" :breadcrumbs="[
    'Back to crews' => route('crews.index'),
    $crew->name => route('crews.show', $crew),
    'Edit' => null,
]" />
@endsection

@section('content')
<x-card title="Edit crew">
    <form action="{{ route('crews.update', $crew) }}" method="post" autocomplete="off">
        @include('crews._form')
        @method('put')
        <br>
        <div class="text-end">
            <button class="btn btn-warning" type="submit">Update crew</button>
            <a href="{{ route('crews.show', $crew) }}" class="btn btn-primary">Back</a>
        </div>
    </form>
</x-card>
<br>

@push('scripts')
@include('crews._form.script-text-color-mode')
@endpush

<x-custom.modal-confirm-delete :route="route('crews.destroy', $crew)" concept="crew">
    <p>¿Do you want to continue to delete the crew <br> <b><?= $crew->name ?></b>?</p>
</x-custom.modal-confirm-delete>
@endsection
