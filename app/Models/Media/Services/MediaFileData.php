<?php 

namespace App\Models\Media\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class MediaFileData
{
    public static function generate(UploadedFile $file, array $extra = [])
    {
        return array_merge($extra, [
            'name' => self::originalNameAlphaNumeric($file) . '.' . $file->extension(),
            'hashed' => $file->hashName(),
            'size_bytes' => $file->getSize(),
            'type_mime' => $file->getClientMimeType(),
        ]);
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
