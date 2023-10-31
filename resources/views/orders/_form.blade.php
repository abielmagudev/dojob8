{{-- Client --}}
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
        </ul>
        <a href="{{ route('clients.show', $client) }}">See more</a>
    </div>
</div>

{{-- Schedule --}}
<div class="mb-3">
    <label for="inputScheduleDate" class="form-label">Schedule</label>
    <div class="row">
        <div class="col-sm">
            <input type="date" class="form-control {{ bsInputInvalid( $errors->has('scheduled_date') ) }}" id="inputScheduleDate" name="scheduled_date" value="{{ old('scheduled_date', $order->scheduled_date) }}">
            <x-error name="scheduled_date"></x-error>
        </div>
        <div class="col-sm">
            <input type="time" class="form-control {{ bsInputInvalid( $errors->has('scheduled_time') ) }}" id="inputScheduleTime" name="scheduled_time" value="{{ old('scheduled_time', $order->scheduled_time_without_miliseconds) }}">
            <x-error name="scheduled_time"></x-error>
        </div>
    </div>
</div>

{{-- Job --}}
<div class="mb-3">
    <label for="selectJob" class="form-label">Job</label>
    
    {{-- Select Job for create order --}}
    @if( is_null($order->id) )
    <select id='selectJob' class="form-select {{ bsInputInvalid( $errors->has('job') ) }}" name="job">
        <option disabled selected label="Choose a job"></option>
        @foreach($jobs as $job)
        <option value="{{ $job->id }}" data-has-extensions="{{ (int) $job->hasExtensions() }}" {{ isSelected( old('job') == $job->id ) }}>{{ $job->name }}</option>
        @endforeach
    </select>
    <x-error name="job"></x-error>
    
    {{-- Show job for edit order --}}
    @else
    <div class="form-control bg-light">{{ $order->job->name }}</div>

    @endif
</div>

{{-- Extensions of job selected or saved --}}
<div id="extensions">

    {{-- Loading image --}}
    <div id="loading" class="mb-3 d-none">  
        <div class="spinner-border spinner-border-sm" role="status"></div>
        <span>Loading extensions...</span>   
    </div>

    {{-- Templates container --}}
    <div id="container" class="mb-3 d-none">
        <label class="form-label">Extensions</label>
        <div id='templates'></div>
    </div>

    {{-- Template clone --}}
    <template id="template">
        <div class="alert alert-light"></div>
    </template>
</div>

{{-- Notes --}}
<div class="mb-3">
    <label for="textareaNotes" class="form-label">Notes</label>
    <textarea name="notes" id="textareaNotes" rows="3" class="form-control">{{ old('notes', $order->notes) }}</textarea>
</div>

@csrf
