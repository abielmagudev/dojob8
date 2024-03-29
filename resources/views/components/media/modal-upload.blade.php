<!-- Trigger -->
<x-modal-trigger modal-id="MediaFileUploaderModal">
    @if( $slot->isEmpty() )
    <i class="bi bi-plus-lg"></i>
    
    @else
    {!! $slot !!}

    @endif
</x-modal-trigger>

<!-- Modal -->
@push('end')
<x-modal id="MediaFileUploaderModal" title="Photos & Documents" dialog-class="modal-xl" header-close>
    <form action="{{ $action }}" method="post" enctype="multipart/form-data" autocomplete="off" id="MediaFileUploaderForm">
        @csrf
        <label for="inputMediaFiles" class="border border-secondary rounded w-100 p-5 text-center fs-5" style="border-style:dashed !important">Click to choose files...</label>
        <input id="inputMediaFiles" class="d-none" type="file" name="media[]" accept="{{ \App\Models\Media\Services\MediaFileRestriction::accepts()->implode(',') }}" multiple>
        
        <div class="d-flex justify-content-end mt-4 gap-2">
            <x-modal-button-close>
                Cancel
            </x-modal-button-close>
            <button id="MediaFileUploaderButton" class="btn btn-success" form="MediaFileUploaderForm" type="submit">
                <div>
                    <i class="bi bi-cloud-arrow-up-fill"></i>
                    <span class="ms-1">Upload</span>
                </div>    
                <div class="d-none">
                    <i class="spinner-border spinner-border-sm" role="status">
                        <span class="visually-hidden">Uploading...</span>
                    </i>
                    <span class="ms-1">Uploading...</span>
                </div>
            </button>
        </div>
    </form>
</x-modal>
@endpush

@push('scripts')
<script>
const inputMediaFiles = {
    element: document.getElementById('inputMediaFiles'),
    count: function () {
        this.element.files.length
    },
    clear: function () {
        this.element.value = null
        this.toggleMessage(0)
    },
    toggleMessage: function (count_value_files) {
        let message = count_value_files > 0 ? `${count_value_files} Files selected` : 'Click to choose files...';
        this.setMessage(message)
    },
    setMessage: function (message) {
        this.element.previousElementSibling.textContent = message
    },
    listen: function () {
        this.element.addEventListener('change', function (evt) {
            inputMediaFiles.toggleMessage( evt.target.files.length )
        })
    }
}
inputMediaFiles.listen()

const MediaFileUploaderButton = {
    element: document.getElementById('MediaFileUploaderButton'),
    listen: function () {
        this.element.addEventListener('click', function (evt) {
            this.querySelector('div:first-child').classList.add('d-none')
            this.querySelector('div:last-child').classList.remove('d-none')
            this.closest('form').submit()
            this.disabled = true
        })
    }
}
MediaFileUploaderButton.listen()

const MediaFileUploaderModal = {
    element: document.getElementById('MediaFileUploaderModal'),
    listen: function () {
        this.element.addEventListener('hidden.bs.modal', function (evt) {
            inputMediaFiles.clear()
        })
    }
}
MediaFileUploaderModal.listen()
</script>
@endpush
