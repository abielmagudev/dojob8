<div class="row mb-3">
    <div class="col-md">
        <label for="selectJob" class="form-label">Job</label>
    </div>
    <div class="col-md col-md-9 col-lg-10">
        {{-- Select Job for create order --}}
        @if( is_null($order->id) )
        <select id='selectJob' class="form-select {{ bsInputInvalid( $errors->has('job') ) }}" name="job" required>
            <option disabled selected label="Choose a job"></option>
            @foreach($jobs as $job)
            <option value="{{ $job->id }}" data-has-extensions="{{ (int) $job->hasExtensions() }}" {{ isSelected( old('job') == $job->id ) }}>{{ $job->name }}</option>
            @endforeach
        </select>
        <x-error name="job"></x-error>
        
        {{-- Show job for edit order --}}
        @else
        <div class="form-control">{{ $order->job->name }}</div>
    
        @endif
    </div>
</div>
