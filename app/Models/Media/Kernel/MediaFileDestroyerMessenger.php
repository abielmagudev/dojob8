<?php

namespace App\Models\Media\Kernel;

class MediaFileDestroyerMessenger
{
    protected $destroyer;

    public function __construct(MediaFileDestroyer $destroyer)
    {
       $this->destroyer = $destroyer; 
    }

    public function status()
    {
        if(! $this->destroyer->wereFilesDestroyed() ||! $this->destroyer->wasDataDestroyed() ) {
            return 'danger';
        }

        return 'success';
    }

    public function message()
    {
        if(! $this->destroyer->wereFilesDestroyed() ||! $this->destroyer->wasDataDestroyed() ) {
            return $this->failed();
        }

        return $this->success();
    }

    public function failed()
    {
        return 'Some files could not be deleted, please check and try again....';
    }
    
    public function success()
    {
        return sprintf('<b>%s</b> files were deleted', $this->destroyer->collection()->count());
    }
}
