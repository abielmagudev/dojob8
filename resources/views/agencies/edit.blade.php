@extends('application')
@section('header')
    <x-breadcrumb :items="[
        'Agencies' => route('agencies.index'),
        $agency->name => route('agencies.show', $agency),
        'Edit'
    ]" />
    <x-page-title>{{ $agency->name }}</x-page-title>
@endsection
@section('content')
    <x-card title="Edit agency">
        <form action="{{ route('agencies.update', $agency) }}" method="post" autocomplete="off">
            @method('put')
            @csrf
            @include('agencies._form')
            <x-custom.switch-active-status :toggle="(bool) old('active', $agency->is_active)">
                <b class="d-block">Active</b>
                <small>If deactivated, it will not be able to be used in new inspections.</small>
            </x-custom.switch-active-status>
            <br>

            <div class="text-end">
                <a href="{{ route('agencies.show', $agency) }}" class="btn btn-outline-primary">Cancel</a>
                <button class="btn btn-warning" type="submit">Update agency</button>
            </div>
        </form>
    </x-card>
    <br>

    <x-custom.modal-confirm-delete :route="route('agencies.destroy', $agency)" concept="agency">
        <p>¿Do you want to continue to delete <br> the agency <b><?= $agency->name ?></b>?</p>
    </x-custom.modal-confirm-delete>
@endsection
