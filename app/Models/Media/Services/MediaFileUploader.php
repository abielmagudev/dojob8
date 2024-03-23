<?php

namespace App\Models\Media\Services;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Facades\Storage;

class MediaFileUploader
{    
    public static function put(UploadedFile $file, Model $model, string $disk = null)
    {
        try {

            $folder = MediaFileDirectory::get($model);

            $path = Storage::putFile($folder, $file);
    
            $data = MediaFileData::generate($file, [
                'disk' => $disk ?? config('filesystems.default'),
                'path' => $path,
                'mediable_type' => get_class($model),
                'mediable_id' => $model->id,
                'created_id' => auth()->id(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return $data;

        } catch (Exception $e) {

            Log::warning($e->getMessage(), [
                'model_class' => get_class($model),
                'model_id' => $model->id,
                'file' => $file->getClientOriginalName(), 
            ]);
        
            return false;

        }
    }
}
