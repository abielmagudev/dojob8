<?php

namespace App\Models;

use App\Models\History\Traits\HasHistory;
use App\Models\Kernel\Traits\BelongsCreatorUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use BelongsCreatorUser;
    use HasHistory;

    protected $table = "uploaded_media";

    protected $fillable = [
        'name',
        'hashed',
        'path',
        // 'url',
        'disk',
        'type_mime',
        'size_bytes',
        'downloads_count',
        'mediable_type',
        'mediable_id',
        'created_id',
    ];


    // Accessors
    
    public function getUrlAttribute()
    {
        return Storage::url( $this->path );
    }


    // Relationships

    public function mediable()
    {
        return $this->morphTo();
    }
}
