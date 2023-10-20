<x-modal id="modalAddExtension" title="Add extension" header-close>
    <form action="{{ route('jobs.extensions.attach', $job) }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="selectExtension" class="form-label">Extension</label>
            <select name="extension" id="selectExtension" class="form-select" required>
                <option disabled selected label="Choose..."></option>
                @foreach($extensions as $extension)
                <option value="{{ $extension->id }}">{{ $extension->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="text-end">
            <button class="btn btn-success" type="submit">Add extension</button>
            <button class="btn btn-dark" type="button" data-bs-dismiss="modal">Cancel</button>
        </div>
    </form>
</x-modal>
