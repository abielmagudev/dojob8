<x-form-control-horizontal>
    <x-slot name="label">
        <label for="textareaNotes" class="form-label">Notes</label>
    </x-slot>
    
    <textarea name="notes" id="textareaNotes" rows="3" class="form-control">{{ old('notes', $work_order->notes) }}</textarea>
</x-form-control-horizontal>
