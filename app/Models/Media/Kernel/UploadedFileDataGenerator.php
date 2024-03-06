<?php

namespace App\Models\Media\Kernel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadedFileDataGenerator
{
    protected $uploaded;

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function uploaded(array $uploaded)
    {
        $this->uploaded = (object) $uploaded;

        return $this;
    }

    public function name()
    {
        return implode('-', [
            $this->model->id, 
            now()->format('ymd'), 
            $this->nameAlphanumeric(),
        ]);
    }

    public function nameAlphanumeric()
    {
        $name_without_extension = pathinfo(
            $this->uploaded->file->getClientOriginalName(),
            PATHINFO_FILENAME
        );
        
        return Str::slug($name_without_extension, '');
    }

    public function nameHashed()
    {
        return md5( $this->name() );
    }

    public function nameWithExtension()
    {
        return sprintf('%s.%s', $this->name(), $this->uploaded->file->extension());
    }

    public function nameHashedWithExtension()
    {
        return sprintf('%s.%s', $this->nameHashed(), $this->uploaded->file->extension());
    }

    public function originalFileInformationJson()
    {
        return json_encode([
            'extension' => $this->uploaded->file->getClientOriginalExtension(),
            'mime' => $this->uploaded->file->getClientMimeType(),
            'name' => $this->uploaded->file->getClientOriginalName(),
            'size' => $this->uploaded->file->getSize(),
            'valid' => $this->uploaded->file->isValid(),
        ]);
    }

    public function nameHashedWithExtensionFromPath()
    {
        return (explode('/', $this->uploaded->path))[2];
    }

    public function directoryFromPath()
    {
        $segments = explode('/', $this->uploaded->path);
    
        return implode('/', [
            $segments[0], 
            $segments[1]
        ]);
    }

    public function flush()
    {
        $this->uploaded = null;
    }

    public function data()
    {
        $data = (object) [
            'name' => $this->nameWithExtension(),
            'name_hashed' => $this->nameHashedWithExtensionFromPath(),
            'extension' => $this->uploaded->file->extension(),
            'disk' => Storage::getDefaultDriver(),
            'directory' => $this->directoryFromPath(),
            'path' => $this->uploaded->path,
            'url' => $this->uploaded->path,
            'original_information_json' => $this->originalFileInformationJson(),
        ];

        $this->flush();

        return $data;
    }
}
