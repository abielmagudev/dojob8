<x-form-field-horizontal for="selectJob" label="Job">

    <div>
        {{-- Select Job for create work order --}}
        @if( is_null($work_order->id) )
        <select id='selectJob' class="form-select {{ bsInputInvalid( $errors->has('job') ) }}" name="job" required>
            <option disabled selected label="Choose..."></option>
            @foreach($jobs as $job)
            <option value="{{ $job->id }}" data-has-extensions="{{ (int) $job->hasExtensions() }}" {{ isSelected( old('job') == $job->id ) }}>{{ $job->name }}</option>
            @endforeach
        </select>
        <x-form-feedback error="job"></x-error>
        
        {{-- Show job for edit work_order --}}
        @else
        <input class="form-control" value="{{ $work_order->job->name }}" disabled>
    
        @endif
    </div>

    {{-- Extensions of job selected or saved --}}
    <div id="extensions">
        {{-- Loading image --}}
        <div id="loading" class="d-none mt-3">  
            <div class="spinner-border spinner-border-sm" role="status"></div>
            <span>Loading extensions...</span>   
        </div>

        {{-- Templates container --}}
        <div id="container" class="d-none mt-3">
            <label class="form-label d-none">Extensions</label>
            <div id='templates'></div>
        </div>

        {{-- Template clone --}}
        <template id="template">
            <div class="alert alert-light"></div>
        </template>
    </div>

</x-form-field-horizontal>
