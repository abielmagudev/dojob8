@extends('application')
<x-header subheader="Extension | Measures">{{ $extension->name }}</x-header>
@section('content')
<x-card title="Edit measure">
    <form action="{{ route('extensions.update', [$extension, 'measure' => $measure->id]) }}" method="post" autocomplete="off">
        @method('put')
        @include($extension->bladeViewPath('_form'))
        <br>

        <div class="text-end">
            <button class="btn btn-warning" type="submit">Update measure</button>
            <a href="{{ route('extensions.show', $extension) }}" class="btn btn-primary">Back</a>
        </div>
    </form>
</x-card>
<br>
<x-custom.modal-confirm-delete concept="measure" route="{{ route('extensions.destroy', [$extension, 'measure' => $measure->id]) }}">
    <p>¿Are you sure to delete the measure <br><b>{{ $measure->name }}</b>?</p>
</x-custom.modal-confirm-delete>
@endsection
