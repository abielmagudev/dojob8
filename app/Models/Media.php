<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = "media";

    protected $fillable = [
        'name',
        'name_hashed',
        'extension',
        'directory',
        'disk',
        'path',
        'url',
        'original_information_json',
        'downloads_count',
        // 'mediable_type',
        // 'mediable_id',
        // 'created_by',
    ];


    // Accessors

    public function getNameWithoutExtensionAttribute()
    {
        return ( explode('.', $this->name) )[0];
    }
    
    public function getPublicUrlAttribute()
    {
        return sprintf('storage/%s', $this->url);
    }


    // Relationships

    public function mediable()
    {
        return $this->morphTo();
    }
}
