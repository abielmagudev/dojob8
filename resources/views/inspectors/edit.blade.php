@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Back to Inspectors' => route('inspectors.index'),
    $inspector->name => route('inspectors.show', $inspector),
    'Edit'
]" />
<x-page-title>{{ $inspector->name }}</x-page-title>
@endsection

@section('content')
<x-card title="Edit inspector">
    <form action="{{ route('inspectors.update', $inspector) }}" method="post" autocomplete="off">
        @include('inspectors._form')
        @method('put')
        <br>
        <div class="text-end">
            <button class="btn btn-warning" type="submit">Update inspector</button>
            <a href="{{ route('inspectors.show', $inspector) }}" class="btn btn-primary">Back</a>
        </div>
    </form>
</x-card>
<br>

<x-custom.modal-confirm-delete :route="route('inspectors.destroy', $inspector)" concept="inspector">
    <p>¿Do you want to continue to delete the inspector <br> <b><?= $inspector->name ?></b>?</p>
</x-custom.modal-confirm-delete>
@endsection
