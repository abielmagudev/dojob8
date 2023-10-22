<div class="mb-3">
    <label class="form-label">Client</label>
    <div class="alert alert-light">
        <ul class="m-0 ps-3">
            <li>{{ $client->fullname }}</li>
            <li>{{ $client->address }}</li>
            <li>{{ $client->location }}, {{ $client->zip_code }}</li>
            
            @empty(! $client->contact)
            <li>{{ $client->contact }}</li>   
            @endempty
           
            @empty(! $client->notes)
            <li>
                <em>{{ $client->notes }}</em>
            </li>           
            @endempty
        </ul>
    </div>
</div>
<div class="mb-3">
    <label for="inputScheduleDate" class="form-label">Schedule</label>
    <div class="row">
        <div class="col-sm">
            <input type="date" class="form-control {{ bsInputInvalid( $errors->has('scheduled_date') ) }}" id="inputScheduleDate" name="scheduled_date" value="{{ old('scheduled_date', $order->scheduled_date) }}">
            <x-error name="scheduled_date"></x-error>
        </div>
        <div class="col-sm">
            <input type="time" class="form-control {{ bsInputInvalid( $errors->has('scheduled_time') ) }}" id="inputScheduleTime" name="scheduled_time" value="{{ old('scheduled_time', $order->scheduled_time) }}">
            <x-error name="scheduled_time"></x-error>
        </div>
    </div>
</div>

{{-- Select job --}}
<div class="mb-3">
    <label for="selectJob" class="form-label">Job</label>

    <div class="mb-3">
        
        {{-- Edit order's job --}}
        @if( $order->id )
        <div class="form-control bg-light">{{ $order->job->name }}</div>
        
        {{-- Create order's job --}}
        @else
        <select class="form-select {{ bsInputInvalid( $errors->has('job') ) }}" name="job" id='selectJob'>
            <option disabled selected label="Choose a job"></option>
            @foreach($jobs as $job)
            <option value="{{ $job->id }}" data-has-extensions="{{ (int) $job->hasExtensions() }}" {{ isSelected( old('job') == $job->id ) }}>{{ $job->name }}</option>
            @endforeach
        </select>
        <x-error name="job"></x-error>
    
        @endif
    </div>

    {{-- Extensions of job selected --}}
    <div id="extensionsJob">

        {{-- Spinner loader image --}}
        <div id="extensionsJobSpinner" class="text-center d-none">       
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="visually-hidden">Loading extensions...</span>
            </div>
            <span>Loading extensions...</span>
        </div>
    
        {{-- Container templates rendered --}}
        <div id='extensionsJobContainer' class="bg-light rounded-1 p-3 d-none"></div>

    </div>
</div>

<div class="mb-3">
    <label for="textareaNotes" class="form-label">Notes</label>
    <textarea name="notes" id="textareaNotes" rows="3" class="form-control">{{ old('notes', $order->notes) }}</textarea>
</div>

@csrf
