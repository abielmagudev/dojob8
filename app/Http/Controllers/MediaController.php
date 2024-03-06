<?php

namespace App\Http\Controllers;

use App\Http\Requests\MediaDestroyRequest;
use App\Http\Requests\MediaStoreRequest;
use App\Models\Media;
use App\Models\Media\Kernel\FileUploader;
use App\Models\Media\Kernel\MediaFileDestroyer;
use App\Models\Media\Kernel\MediaFileDestroyerMessenger;
use App\Models\Media\Kernel\MediaModelContainer;
use App\Models\Media\Kernel\MediaUploadedFileFactory;
use App\Models\Media\Kernel\MediaUploadedFileMessenger;

class MediaController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Media::class, 'media');    
    }

    public function store(MediaStoreRequest $request)
    {        
        // Instances
        $model = MediaModelContainer::find($request->model_key, $request->model_id);
        $uploader = new FileUploader($model);
        $factory = new MediaUploadedFileFactory($model);
        
        // Actions
        $uploader->upload( $request->file('media') );
        $factory->store( $uploader->success()->toArray() );
        // $factory->result()

        // Message
        $messenger = new MediaUploadedFileMessenger($uploader);

        return back()->with($messenger->status(), $messenger->message());
    }

    public function destroy(MediaDestroyRequest $request)
    {
        $destroyer = new MediaFileDestroyer( $request->get('media') );

        $destroyer->files();

        $destroyer->data();

        $messenger = new MediaFileDestroyerMessenger($destroyer);

        return back()->with($messenger->status(), $messenger->message());
    }
}
