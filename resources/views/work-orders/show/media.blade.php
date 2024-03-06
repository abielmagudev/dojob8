@section('head')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endsection

<x-card>  
    @slot('title')
    <span class="badge text-bg-dark">{{ $work_order->media->count() }}</span>
    @endslot

    @slot('options')
    
    @if( $work_order->media->count() )       
    <x-modal-trigger modal-id="mediaDeleteModal" class="btn btn-outline-danger">
        <i class="bi bi-trash3"></i>
    </x-modal-trigger>
    @endif

    <x-modal-trigger modal-id="mediaUploaderModal">
        <i class="bi bi-plus-lg"></i>
    </x-modal-trigger>
    @endslot

    @if( $work_order->media->count() )    
    <div class="row g-3">
        @foreach($work_order->media as $file)
        <div class="col-sm col-md-3 col-xl-2">
            <div class="position-relative bg-black rounded">
                <div class="position-absolute end-0 bg-dark bg-opacity-50 rounded px-1 m-1">
                    <input type="checkbox" class="form-check-input" name="media[]" value="{{ $file->id }}" form="mediaDeleteForm">
                </div>

                <a href="{{ asset($file->public_url) }}" target="_blank" download="{{ $file->name }}">
                    <img src="{{ asset($file->public_url) }}" class="img-fluid mx-auto d-block"/>
                </a>
            </div>
        </div> 
        @endforeach
    </div>
    @endif
</x-card>

@include('work-orders.show.media.modal-uploader')
@include('work-orders.show.media.modal-uploaded-delete')

<?php 
// @include('work-orders.show.media.modal-uploaded-focused') 
// @include('work-orders.show.media.modal-uploaded-dragodrop') 
?>
