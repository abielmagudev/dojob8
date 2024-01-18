<div class="d-none mt-3">
    <select id="reworkSelect" class="form-select" name="rework" disabled required>
        @foreach($client->work_orders as $wo)
        
            @if( $wo->qualifiesForRework() )
            <option value="{{ $wo->id }}">#{{ $wo->id }} - {{ $wo->job->name }}</option>
            @endif
            
        @endforeach
    </select>
    <x-form-helper important>Work orders with <b>completed status</b></x-form-helper>
</div>
