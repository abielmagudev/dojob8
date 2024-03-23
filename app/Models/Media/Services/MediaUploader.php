<?php

namespace App\Models\Media\Services;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaUploader
{    
    public static function put(UploadedFile $file, string $path)
    {
        try
        {
            $path = Storage::putFile($path, $file);

            if(! Storage::exists($path) ) {
                throw new Exception('File not uploaded');;
            }
    
            return array_merge(self::data($file), [
                'disk' => config('filesystems.default'),
                'path' => $path,
            ]);
        } 
        catch (Exception $e)
        {
            Log::warning($e->getMessage(), [
                'class' => __CLASS__,
                'file' => $file->getClientOriginalName(), 
                'path' => $path,
            ]);
        
            return false;
        }
    }

    public static function data(UploadedFile $file)
    {
        return [
            'name' => self::originalNameAlphaNumeric($file) . '.' . $file->extension(),
            'hashed' => $file->hashName(),
            'size_bytes' => $file->getSize(),
            'type_mime' => $file->getClientMimeType(),
        ];
    }

    public static function originalName(UploadedFile $file)
    {
        return pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
    }

    public static function originalNameAlphaNumeric(UploadedFile $file)
    {
        return Str::slug(self::originalName($file), '');
    }
}
