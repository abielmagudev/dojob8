@extends('application')
<x-header subheader="Extension | Measures">{{ $extension->name }}</x-header>
@section('content')
<x-card title="New measure">
    <form action="{{ route('extensions.store', $extension) }}" method="post" autocomplete="off">
        @include('WeatherizationMeasureCps/resources/views/_form')
        <br>

        <div class="text-end">
            <button class="btn btn-success" type="submit">Save measure</button>
            <a href="{{ route('extensions.show', $extension) }}" class="btn btn-primary">Cancel</a>
        </div>
    </form>
</x-card>
@endsection
