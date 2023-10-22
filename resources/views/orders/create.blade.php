@extends('application')
@section('content')
<x-card title="New order">
    <form action="{{ route('orders.store') }}" method="post">
        @include('orders._form')
        <br>
        <div class="text-end">
            <button class="btn btn-success" type="submit">Save order</button>
            <a href="{{ route('orders.index') }}" class="btn btn-primary">Cancel</a>
        </div>
    </form>
</x-card>

{{-- 
@push('scripts') 
    @include('orders._script-job-extensions-loader')
    @include('orders._script-job-extensions-select')

    @if( old('job') )
    <script>
        selectJob.dispatchChangeEvent()
    </script>
    @endif
@endpush
 --}}
@endsection
