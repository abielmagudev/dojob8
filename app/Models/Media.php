<?php

namespace App\Models;

use App\Models\History\Traits\HasHistory;
use App\Models\Kernel\Traits\BelongsCreatorUser;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use BelongsCreatorUser;
    use HasHistory;

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
