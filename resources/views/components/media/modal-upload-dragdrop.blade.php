@section('head')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endsection

<x-modal id="modalDropzoneWorkOrder" title="Upload photos and files" dialog-class="modal-xl" header-close>
    <form action="{{ route('files.store', ['work-orders', $work_order->id]) }}" method="post" enctype="multipart/form-data" class="dropzone bg-secondary bg-opacity-10" style="min-height:auto;border-style:dashed" id="formDropzoneWorkOrder">
        @csrf
        <div class="fallback">
            <input name="files[]" type="file" multiple />
        </div>
    </form>
    <div id="dropzonePreview"></div>
</x-modal>

@push('scripts')   
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script>
Dropzone.autoDiscover = false;

const modalDropzoneWorkOrder = document.getElementById('modalDropzoneWorkOrder');

const formDropzoneWorkOrder = new Dropzone('#formDropzoneWorkOrder', {
    dictDefaultMessage: "Drag and drop or click to <span class='d-block d-md-none'></span> upload photos and files...",
    // autoProcessQueue: true, // Desactiva la carga automática
    // addedfile: function (file) {
    // // Callback que se ejecuta cuando se agrega un archivo
    // // Puedes agregar aquí lógica adicional antes de procesar el archivo
    //     console.log(file)
    // },
    success: function(file, response) {
        console.log(response.message)
        // dropzoneWorkOrder.removeFile(file);        
    }
});

formDropzoneWorkOrder.on('success', function () {
    modalDropzoneWorkOrder.addEventListener('hide.bs.modal', event => {
        location.reload();
    })
})
</script>
@endpush
