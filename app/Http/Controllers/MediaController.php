<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MediaController\MediaManagerContainer;
use App\Http\Requests\MediaDestroyRequest;
use App\Http\Requests\MediaStoreRequest;
use App\Models\Assessment;
use App\Models\Inspection;
use App\Models\Media;
use App\Models\Media\Services\MediaUploader;
use App\Models\WorkOrder;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    protected $media_models = [
        'assessments' => Assessment::class,
        'inspections' => Inspection::class,
        'work-orders' => WorkOrder::class,
    ];

    public function __construct()
    {
        $this->authorizeResource(Media::class, 'media');
    }

    public function store(MediaStoreRequest $request, $model_key, $model_id)
    {        
        $media_model = array_key_exists($model_key, $this->media_models) ? $this->media_models[$model_key] : null;

        if( is_null($media_model) ||! $model = $media_model::find($model_id) ) {
            abort(404);
        }

        $files = collect($request->file('media'));

        $uploaded = collect([]);

        foreach($files as $file)
        {
            if( $data = MediaUploader::put($file, "{$model_key}/{$model->id}") )
            {
                $data['mediable_type'] = $media_model;
                $data['mediable_id'] = $model->id;
                $data['created_id'] = auth()->id();
                $uploaded->push($data);
            }
        }

        Media::insert($uploaded->toArray());

        $model->history()->create([
            'description' => sprintf("%s files were uploaded in %s #%s", $uploaded->count(), $model_key, $model->id),
            'link' => route("{$model_key}.show", $model),
            'user_id' => auth()->id(),
        ]);

        $message = $files->count() == $uploaded->count()
                 ? ['success', sprintf('%s files uploaded', $uploaded->count())] 
                 : ['warning', sprintf('%s/%s files uploaded', $uploaded->count(), $files->count())];

        return back()->with($message[0], $message[1]);
    }

    public function destroy(MediaDestroyRequest $request, $model_key, $model_id)
    {
        $media_model = array_key_exists($model_key, $this->media_models) ? $this->media_models[$model_key] : null;

        if( is_null($media_model) ||! $model = $media_model::find($model_id) ) {
            abort(404);
        }

        $media = $model->media()->whereIn('id', $request->get('media'))->get();

        $destroyed = collect([]);

        foreach($media as $file)
        {
            Storage::delete($file->path);

            if(! Storage::exists($file->path) ) {
                $destroyed->push($file);
            }
        }

        $model->media()->whereIn('id', $destroyed->pluck('id')->toArray())->delete();

        $model->history()->create([
            'description' => sprintf("%s files were deleted in %s #%s", $destroyed->count(), $model_key, $model->id),
            'link' => route("{$model_key}.show", $model),
            'user_id' => auth()->id(),
        ]);

        $message = $media->count() == $destroyed->count()
                 ? ['success', sprintf('%s files deleted', $destroyed->count())] 
                 : ['warning', sprintf('%s/%s files uploaded', $destroyed->count(), $media->count())];

        return back()->with($message[0], $message[1]);
    }
}
