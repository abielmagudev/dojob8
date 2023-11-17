<div class="row mb-3">
    <div class="col-md">
        <label for="textareaNotes" class="form-label">Notes</label>
    </div>
    <div class="col-md col-md-9 col-lg-10">
        <textarea name="notes" id="textareaNotes" rows="3" class="form-control">{{ old('notes', $order->notes) }}</textarea>
    </div>
</div>
