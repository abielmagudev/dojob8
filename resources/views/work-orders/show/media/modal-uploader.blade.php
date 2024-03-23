<x-modal id="mediaUploaderModal" title="Photos & Documents" header-close>
    <form action="{{ route('media.store', ['work-orders', $work_order->id]) }}" method="post" enctype="multipart/form-data" autocomplete="off" id="mediaUploaderForm">
        @csrf
        <label for="inputMediaFiles" class="border border-secondary rounded w-100 p-5 text-center fs-5" style="border-style:dashed !important">Click to choose files...</label>
        <input id="inputMediaFiles" class="d-none" type="file" name="media[]" accept="{{ $accepts->implode(',') }}" multiple>
        
        <div class="d-flex justify-content-end mt-4 gap-2">
            <x-modal-button-close>
                Cancel
            </x-modal-button-close>
            <button id="mediaUploaderButton" class="btn btn-success" form="mediaUploaderForm" type="submit">
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

const mediaUploaderButton = {
    element: document.getElementById('mediaUploaderButton'),
    listen: function () {
        this.element.addEventListener('click', function (evt) {
            this.querySelector('div:first-child').classList.add('d-none')
            this.querySelector('div:last-child').classList.remove('d-none')
            this.closest('form').submit()
            this.disabled = true
        })
    }
}
mediaUploaderButton.listen()

const mediaUploaderModal = {
    element: document.getElementById('mediaUploaderModal'),
    listen: function () {
        this.element.addEventListener('hidden.bs.modal', function (evt) {
            inputMediaFiles.clear()
        })
    }
}
mediaUploaderModal.listen()
</script>
@endpush
