@extends('application')

@section('header')
<x-breadcrumb :items="[
    'Configuration' => route('configuration.index'),
    'Edit'
]" />
<x-page-title>Configuration</x-page-title>
@endsection

@section('content')
<x-card title="Edit configuration">
    <form action="{{ route('configuration.update', $configuration) }}" method="post" autocomplete="off">
        @csrf
        @method('put')
        <div class="mb-3">
            <label for="companyNameInput" class="form-label">Company name</label>
            <input type="text" class="form-control {{ bsInputInvalid( $errors->has('company_name') ) }}" name="company_name" value="{{ old('company_name', $configuration->company_name) }}" required>
            <x-form-feedback error="company_name" />
        </div>
        <br>

        <div class="text-end">
            <button type="submit" class="btn btn-warning">Update configuration</button>
            <a href="{{ route('configuration.index') }}" class="btn btn-primary">Back</a>
        </div>
    </form>
</x-card>
@endsection
