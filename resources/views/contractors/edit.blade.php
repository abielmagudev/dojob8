@extends('application')

@section('header')
<x-header title="Contractor" :breadcrumbs="[
    'Back to contractors' => route('contractors.index'),
    $contractor->name => route('contractors.show', $contractor),
    'Edit' => null
]" />
@endsection

@section('content')
<x-card title="Edit intermediary">
    <form action="{{ route('contractors.update', $contractor) }}" method="post" autocomplete="off">
        @include('contractors._form')
        @method('put')
        <br>
        <div class="text-end">
            <button type="submit" class="btn btn-warning">Update contractor</button>
            <a href="{{ route('contractors.show', $contractor) }}" class="btn btn-primary">Back</a>
        </div>
    </form>
</x-card>
<br>

<x-custom.modal-confirm-delete :route="route('contractors.destroy', $contractor)" concept="contractor">
    <p>¿Do you want to continue to delete the intermediary <br> <b><?= $contractor->name ?> ({{ $contractor->alias }})</b>?</p>
</x-custom.modal-confirm-delete>
@endsection
