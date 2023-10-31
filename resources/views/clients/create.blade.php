@extends('application')
@section('content')
<x-card title="New client">
    <form action="{{ route('clients.store') }}" method="POST" autocomplete="off">
        @include('clients._form')
        <br>
        <div class="text-end">
            <button class="btn btn-success" type="submit" name="redirect" value="{{ request('redirect', 'clients') }}">Save client</button>
            <a href="{{ route('clients.index') }}" class="btn btn-primary">Cancel</a>
        </div>
    </form>
</x-card>
@endsection
