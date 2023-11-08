@extends('application')
<x-header subheader="Products">{{ $extension->name }}</x-header>
@section('content')
<x-card title="New product">
    <form action="{{ route('extensions.store', [$extension, 'concept' => 'product']) }}" method="post" autocomplete="off">
        @include('CpsProductMeasures/views/products/_form')
        <br>

        <div class="text-end">
            <div class="d-inline-block">
                <div class="dropdown">
                    <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span>Save product</span>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <button class="dropdown-item" type="submit" name="after_saving" value="1">... and create another product</button>
                        </li>
                        <li>
                            <button class="dropdown-item" type="submit" name="after_saving" value="0">... and finish</button>
                        </li>
                    </ul>
                </div>
            </div>
            <a href="{{ route('extensions.show', [$extension, 'concept' => 'product']) }}" class="btn btn-primary">Cancel</a>
        </div>
    </form>
</x-card>
@endsection
