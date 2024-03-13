<?php

namespace App\Observers;

use App\Models\Media;

class MediaObserver
{
    public function created(Media $media)
    {
        Media::withoutEvents(function() use ($media) {
            $media->created_id = auth()->id();
            $media->save();
        });

        $media->history()->create([
            'description' => sprintf("Media #<b>{$media->id}</b> ({$media->name_without_extension}) was created."),
            'user_id' => auth()->id(),
        ]);
    }

    public function deleted(Media $media)
    {
        $media->history()->deleted();

        $media->history()->create([
            'description' => sprintf("Media #<b>{$media->id}</b> ({$media->name_without_extension}) was deleted."),
            'user_id' => auth()->id(),
        ]);
    }
}
