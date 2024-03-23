<?php

namespace App\Models\Media\Services;

use App\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MediaFileDestroyer
{
    public static function delete(Media $media)
    {
        Storage::delete($media->path);

        if( Storage::exists($media->path) ) {
            return false;
        }

        return $media;
    }

    public static function model(Model $model)
    {
        $destroyed = collect([]);

        $media = $model->media;

        foreach($media as $file) {
            if( self::delete($file) ) {
                $destroyed->push($file);
            }
        }

        return $destroyed;
    }
}
