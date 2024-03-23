<x-card>  
    <x-slot name="title">
        <span class="badge text-bg-dark">{{ $media->count() }}</span>
    </x-slot>

    <x-slot name="options">
        @can('delete-media')   
            @if( $media->count() )       
            <x-media.modal-uploaded-delete action="{{ $actionDelete }}" />
            @endif
        @endcan
        
        @can('create-media')   
            <x-media.modal-upload action="{{ $actionUpload }}" />
        @endcan
    </x-slot>

    @if( $media->count() )    
    <div class="row g-3">
        @foreach($media as $file)
        <div class="col-sm col-md-3 col-xl-2">
            <div class="position-relative bg-black rounded">
                <div class="position-absolute end-0 bg-dark bg-opacity-50 rounded px-1 m-1">
                    <input type="checkbox" class="form-check-input" name="media[]" value="{{ $file->id }}" form="mediaDeleteForm">
                </div>

                <a href="{{ asset($file->url) }}" target="_blank" download="{{ $file->name }}">
                    <img src="{{ $file->url }}" class="img-fluid mx-auto d-block"/>
                </a>
            </div>
        </div> 
        @endforeach
    </div>
    @endif
</x-card>
