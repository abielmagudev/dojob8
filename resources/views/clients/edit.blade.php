@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Clients' => route('clients.index'),
    $client->full_name => route('clients.show', $client),
    'Edit',
]" />
<x-page-title>{{ $client->full_name }}</x-page-title>
@endsection

@section('content')
<x-card title="Edit client">
    <form action="{{ route('clients.update', $client) }}" method="POST" autocomplete="off">
        @include('clients._form')
        @method('put')
        <br>
        <div class="text-end">
            <button class="btn btn-warning" type="submit">Update client</button>
            <a href="{{ route('clients.show', $client) }}" class="btn btn-primary">Back</a>
        </div>
    </form>
</x-card>
<br>

<x-custom.modal-confirm-delete route="{{ route('clients.destroy', $client) }}" concept="client">
    <p>¿Do you want to continue to delete the client <br> <b><?= $client->full_name ?></b>?</p>
</x-custom.modal-confirm-delete>
@endsection
