<x-form-control-horizontal>
    <x-slot name="label">
        <label for="selectJob" class="form-label">Job</label>
    </x-slot>

    {{-- Select Job for create work order --}}
    @if( is_null($work_order->id) )
    <select id='selectJob' class="form-select {{ bsInputInvalid( $errors->has('job') ) }}" name="job" required>
        <option disabled selected label="Choose a job"></option>
        @foreach($jobs as $job)
        <option value="{{ $job->id }}" data-has-extensions="{{ (int) $job->hasExtensions() }}" {{ isSelected( old('job') == $job->id ) }}>{{ $job->name }}</option>
        @endforeach
    </select>
    <x-error name="job"></x-error>
    
    {{-- Show job for edit work_order --}}
    @else
    <div class="form-control">{{ $work_order->job->name }}</div>

    @endif
</x-form-control-horizontal>
