<?php 

namespace App\Models\Media\Kernel;

use App\Models\Media;
use Illuminate\Database\Eloquent\Model;

class MediaUploadedFileFactory
{
    protected $result = [];

    protected $model;

    protected $generator;

    public function __construct(Model $model)
    {
        $this->model = $model;

        $this->generator = new UploadedFileDataGenerator($model);
    }

    public function store(array $files_uploaded)
    {
        foreach($files_uploaded as $uploaded)
        {
            $data = $this->generator->uploaded($uploaded)->data();

            $this->result[] = $this->model->media()->create([
                'name' => $data->name,
                'name_hashed' => $data->name_hashed,
                'extension' => $data->extension,
                'directory' => $data->directory,
                'disk' => $data->disk,
                'path' => $data->path,
                'url' => $data->url,
                'original_information_json' => $data->original_information_json,
            ]);
        }
    }

    public function result()
    {
        return collect( $this->result );
    }

    public function success()
    {
        return $this->result()->filter(fn($media) => is_a($media, Media::class));
    }

    public function failed()
    {
        return $this->result()->filter(fn($media) => ! is_a($media, Media::class));
    }
}
