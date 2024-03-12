<?php

namespace App\Models\Media\Kernel;

use App\Models\Media;
use App\Models\WorkOrder;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Facades\Storage;

class MediaFileDestroyer
{
    protected $collection;

    public function __construct(array $media_ids)
    {
        $this->collection = Media::whereIn('id', $media_ids)->get();
    }

    public function collection()
    {
        return $this->collection;
    }

    // Files

    public function pathFiles()
    {
        return $this->collection->pluck('path')->toArray();
    }

    public function files()
    {
        foreach($this->pathFiles() as $path) {
            Storage::delete($path);
        }
        
        if(! $this->wereFilesDestroyed() )
        {
            $path_files_string = implode(', ', $this->filesNotDestroyed());
            Log::error('Error destroying media files.', ['path-files' => $path_files_string]);
        }
    }

    public function wereFilesDestroyed()
    {
        $existing_files = array_filter($this->pathFiles(), function($path) {
            return Storage::exists($path);
        });

        return count($existing_files) == 0;
    }

    public function filesNotDestroyed()
    {
        return array_filter($this->pathFiles(), function($path) {
            return Storage::exists($path);
        });
    }


    // Data

    public function media_ids()
    {
        return $this->collection->pluck('id')->toArray();
    }

    public function data()
    {
        $query = Media::whereIn('id', $this->media_ids());
        
        if(! $this->wereFilesDestroyed() ) {
            $query->whereIn('path', $this->filesNotDestroyed());
        }

        $query->delete();

        if(! $this->wasDataDestroyed() )
        {
            $media_ids_text = $this->dataNotDestroyed()->pluck('id')->implode(', ');
            Log::error('Error destroying media data.', ['media-id' => $media_ids_text]);
        }
    }

    public function wasDataDestroyed()
    {
        $media_files = Media::whereIn('id', $this->media_ids())->get();

        return $media_files->count() == 0;
    }

    public function dataNotDestroyed()
    {
        return Media::whereIn('id', $this->media_ids())->get();
    }


    // Statics

    public static function byWorkOrder(WorkOrder $work_order)
    {
        $path_relative = sprintf('work-orders/%s', $work_order->id);

        if( Storage::exists($path_relative) ) {
            Storage::deleteDirectory($path_relative);
        }

        return ! Storage::exists($path_relative);
    }
}
