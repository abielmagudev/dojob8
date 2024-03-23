<?php

namespace App\Http\Controllers;

use App\Http\Requests\MediaDestroyRequest;
use App\Http\Requests\MediaStoreRequest;
use App\Models\Assessment;
use App\Models\Inspection;
use App\Models\Media;
use App\Models\Media\Services\MediaFileDestroyer;
use App\Models\Media\Services\MediaFileUploader;
use App\Models\Member;
use App\Models\User;
use App\Models\WorkOrder;

class MediaController extends Controller
{
    protected $models = [
        'assessments' => Assessment::class,
        'inspections' => Inspection::class,
        'members' => Member::class,
        'users' => User::class,
        'work-orders' => WorkOrder::class,
    ];


    public function __construct()
    {
        $this->authorizeResource(Media::class, 'media');
    }

    public function bind($model_key, $model_id)
    {
        if(! array_key_exists($model_key, $this->models) ) {
            return abort(404);
        }

        $class = $this->models[$model_key];

        return $class::findOrFail($model_id);
    }

    public function store(MediaStoreRequest $request, $model_key, $model_id)
    {        
        $model = $this->bind($model_key, $model_id);

        $files = collect($request->file('media'));

        $uploaded = collect([]);

        foreach($files as $file)
        {
            if( $data = MediaFileUploader::put($file, $model) ) {        
                $uploaded->push($data);
            }
        }

        Media::insert( $uploaded->toArray() );

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
        $model = $this->bind($model_key, $model_id);

        $media = $model->media()->whereIn('id', $request->get('media'))->get();

        $destroyed = collect([]);

        foreach($media as $file)
        {
            if( MediaFileDestroyer::delete($file) ) {
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
