<?php

namespace App\Models;

use App\Models\History\Traits\HasHistory;
use App\Models\Kernel\Traits\BelongsCreatorUser;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use BelongsCreatorUser;
    use HasHistory;

    protected $table = "uploaded_media";

    protected $fillable = [
        'name',
        'url',
        'disk',
        'type_mime',
        'size_bytes',
        'downloads_count',
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
