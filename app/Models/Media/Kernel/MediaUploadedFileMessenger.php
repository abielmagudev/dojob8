<?php

namespace App\Models\Media\Kernel;

class MediaUploadedFileMessenger
{
    protected $uploader;

    public function __construct(FileUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    public function status()
    {
        if( $this->uploader->success()->isEmpty() ) {
            return 'danger';
        }

        if( $this->uploader->failed()->isNotEmpty() ) {
            return 'warning';
        }

        return 'success';
    }

    public function message()
    {
        if( $this->uploader->success()->isEmpty() ) {
            return $this->failed();
        }

        if( $this->uploader->failed()->isNotEmpty() ) {
            return $this->warning();
        }

        return $this->success();
    }

    public function success()
    {
        return sprintf('<b>%s</b> files were uploaded', $this->uploader->success()->count());
    }

    public function warning()
    {
        return sprintf('Only <b>%s</b> uploaded, check uploaded files...', $this->uploader->comparisonText());
    }

    public function failed()
    {
        return 'No file could be uploaded, please try again...';
    }
}
