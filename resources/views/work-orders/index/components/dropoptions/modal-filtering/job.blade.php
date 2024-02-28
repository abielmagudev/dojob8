{{-- Jobs --}}
@isset( $filtering['jobs'] )   
<div class="mb-3">
    <label for="filterJobSelect" class="form-label">Job</label>
    <select id="filterJobSelect" class="form-select" name="job">
        <option label="Any job" selected></option>

        @foreach($filtering['jobs'] as $job)
        <option value="{{ $job->id }}" {{isSelected($job->id == $request->get('job')) }}>{{ $job->name }}</option>
        @endforeach
    </select>
</div>
@endisset
