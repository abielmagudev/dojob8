<x-form-field-horizontal for="textareaNotes" label="Notes">
    <textarea name="notes" id="textareaNotes" rows="3" class="form-control">{{ old('notes', $work_order->notes) }}</textarea>
</x-form-field-horizontal>
