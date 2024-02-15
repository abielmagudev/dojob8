<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $table="uploaded_files";

    protected $fillable = [
        'filename',
        'url',
        'disk',
        'fileable_type',
        'fileable_id',
    ];

    public static $mime_types = [
        'jpeg',
        'jpg',
        'png',
        'pdf',
        'xls',
    ];

    public static $folderss_fileabe_classes = [
        'inspections' => Inspection::class,
        'work-orders' => WorkOrder::class,
    ];


    // Relationships

    public function fileable()
    {
        return $this->morphTo(__FUNCTION__);
    }


    // Statics

    public static function getMimeTypes()
    {
        return collect( self::$mime_types );
    }

    public static function getFoldersFileableClasses()
    {
        return collect( self::$folderss_fileabe_classes );
    }

    public static function getFolders()
    {
        return self::getFoldersFileableClasses()->keys();
    }

    public static function getFileableClasses()
    {
        return self::getFoldersFileableClasses()->values();
    }

    public static function getFileableClass($key_folder)
    {
        return self::getFoldersFileableClasses()->get($key_folder);
    }
}
