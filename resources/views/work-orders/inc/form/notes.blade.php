<x-form-field-horizontal for="textareaNotes" label="Notes" label-class="form-label-optional">
    <textarea name="notes" id="textareaNotes" rows="3" class="form-control {{ bsInputInvalid( $errors->has('notes') ) }}">{{ old('notes', $work_order->notes) }}</textarea>
</x-form-field-horizontal>
