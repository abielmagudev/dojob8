<?php

namespace App\Models\Media\Kernel;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Facades\Storage;

class FileUploader
{
    protected $model_directory;

    protected $success = [];

    protected $failed = [];

    public function __construct(Model $model)
    {
        $this->model_directory = MediaModelDirectory::get($model);
    }

    /**
     * https://laravel.com/docs/8.x/filesystem#file-uploads
     */
    public function upload(array $files)
    {
        foreach($files as $file)
        {
            try
            {
                $path = Storage::putFile($this->model_directory, $file);

                if(! Storage::exists($path) ) {
                    throw new Exception('The uploaded file was not found');
                }

                $this->success[] = [
                    'file' => $file,
                    'path' => $path
                ];
            } 
            catch (\Exception $e) 
            {
                Log::warning($e->getMessage(), [
                    'class' => __CLASS__,
                    'file' => $file->getClientOriginalName(), 
                ]);

                $this->failed[] = $file;
            }
        }
    }

    public function success()
    {
        return collect( $this->success );
    }

    public function failed()
    {
        return collect( $this->failed );
    }

    public function comparisonArray()
    {
        return [
            $this->success()->count(),
            $this->failed()->count(),
        ];
    }

    public function comparisonText(string $glue = '/')
    {
        return implode($glue, $this->comparisonArray());
    }
}
