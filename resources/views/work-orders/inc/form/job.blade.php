<x-form-field-horizontal for="jobSelect" label="Job">

    <div>
        @if( is_null($work_order->id) )
        <select id='jobSelect' class="form-select {{ bsInputInvalid( $errors->has('job') ) }}" name="job" required>
            <option disabled selected label="Choose..."></option>
            @foreach($jobs as $job)
            <option value="{{ $job->id }}" {{ isSelected( old('job') == $job->id ) }}>{{ $job->name }}</option>
            @endforeach
        </select>
        <x-form-feedback error="job"></x-error>
        
        @else
        <div class="form-control bg-body-tertiary">{{ $work_order->job->name }}</div>
    
        @endif
    </div>
</x-form-field-horizontal>
