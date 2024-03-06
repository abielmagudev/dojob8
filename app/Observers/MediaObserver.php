<?php

namespace App\Observers;

use App\Models\Media;

class MediaObserver
{
    public function created(Media $media)
    {
        Media::withoutEvents(function() use ($media) {
            $media->created_by = auth()->id();
            $media->save();
        });
    }

    public function updated(Media $media)
    {
        //
    }

    public function deleted(Media $media)
    {
        //
    }
}
