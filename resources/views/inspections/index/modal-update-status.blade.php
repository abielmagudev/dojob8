<x-modal id="modalInspectionStatusUpdate" title="Update status of inspections selected" header-close>
    <form action="{{ route('inspections.update.status') }}" method="post" id="formInspectionStatusUpdate">
        @method('patch')
        @csrf
        <div class="mb-3">
            <label for="statusSelect" class="form-label">Status</label>
            <select id="statusSelect" class="form-select" name="status" required>
                @foreach($all_statuses_form as $status)
                <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </div>
        <input type="hidden" name="url_back" value="{{ $request->fullUrl() }}">
    </form>

    @slot('footer')
    <x-modal-button-close>Close</x-modal-button-close>
    <button class="btn btn-warning" type="submit" form="formInspectionStatusUpdate">Update inspections</button>
    @endslot
</x-modal>
