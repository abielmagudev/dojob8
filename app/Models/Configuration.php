<?php

namespace App\Models;

use App\Models\History\Traits\HasHistory;
use App\Models\Kernel\Traits\BelongsCreatorUser;
use App\Models\Kernel\Traits\BelongsDeleterUser;
use App\Models\Kernel\Traits\BelongsUpdaterUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Configuration extends Model
{
    use BelongsCreatorUser;
    use BelongsDeleterUser;
    use BelongsUpdaterUser;
    use HasFactory;
    use HasHistory;
    use SoftDeletes;

    protected $table = 'configuration';

    protected $fillable = [
        'settings_json',
    ];

    private static $singleton;


    // Mutators

    public function setSettingsJsonAttribute($values)
    {
        $this->attributes['settings_json'] = json_encode($values);
    }
    
    // Accessors

    public function getSettingsArrayAttribute()
    {
        return json_decode($this->settings_json, true);
    }


    // Actions

    public function get(string $key, $default = null, $strict = false)
    {
        if( $strict )
        {
            return isset($this->settings_array[$key]) &&! empty($this->settings_array[$key]) 
                    ? $this->settings_array[$key] 
                    : $default;
        }

        return array_key_exists($key, $this->settings_array) 
                ? $this->settings_array[$key] 
                : $default;
    }


    // Scopes

    public function scopeLast($query)
    {
        return $query->latest()->first();
    }


    // Statics

    public static function singleton()
    {
        if( is_null(self::$singleton) ) {
            self::$singleton = self::latest()->first();
        }

        return self::$singleton;
    }
}
