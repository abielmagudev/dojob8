@section('head')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endsection

<x-card title="35">  
    <x-slot name="options">
        <x-modal-trigger modal-id="modalDropzoneWorkOrder">
            <i class="bi bi-plus-lg"></i>
        </x-modal-trigger>
    </x-slot>

    <div class="row g-3">
        @for($i = 1; $i <= 16; $i++)
        <div class="col-sm col-md-3 col-xl-2">
            <div class="position-relative bg-black rounded">
                <div class="position-absolute end-0 bg-dark bg-opacity-50 rounded px-1 m-1">
                    <input type="checkbox" class="form-check-input" name="files[]">
                </div>

                <img src="https://picsum.photos/{{ mt_rand(200, 400) }}/{{ mt_rand(200, 300) }}" class="img-fluid mx-auto d-block" role="button" data-bs-toggle="modal" data-bs-target="#modalFocused" />
            </div>
        </div> 
        @endfor
    </div>
</x-card>

@include('work-orders.show.files.modal-focused')
@include('work-orders.show.files.modal-dropzone')
