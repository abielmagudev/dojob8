@extends('application')

@section('header')
<x-header title="Intermediaries" :breadcrumbs="[
    'Back to intermediaries' => route('intermediaries.index'),
    $intermediary->name => route('intermediaries.show', $intermediary),
    'Edit' => null
]" />
@endsection

@section('content')
<x-card title="Edit intermediary">
    <form action="{{ route('intermediaries.update', $intermediary) }}" method="post" autocomplete="off">
        @include('intermediaries._form')
        @method('put')
        <br>
        <div class="text-end">
            <button type="submit" class="btn btn-warning">Update intermediary</button>
            <a href="{{ route('intermediaries.show', $intermediary) }}" class="btn btn-primary">Back</a>
        </div>
    </form>
</x-card>
<br>

<x-custom.modal-confirm-delete :route="route('intermediaries.destroy', $intermediary)" concept="intermediary">
    <p>¿Do you want to continue to delete the intermediary <br> <b><?= $intermediary->name ?> ({{ $intermediary->alias }})</b>?</p>
</x-custom.modal-confirm-delete>
@endsection
