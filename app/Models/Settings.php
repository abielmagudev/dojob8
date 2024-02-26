<?php

namespace App\Models;

use App\Models\Kernel\Traits\HasHookUsers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Settings extends Model
{
    use HasFactory;
    use HasHookUsers;
    use SoftDeletes;

    protected $table = 'settings';

    protected $fillable = [
        'data_json',
        'created_by',
        'updated_by',
    ];

    private static $singleton;

    
    // Attributes

    public function getDataArrayAttribute()
    {
        return json_decode($this->data_json, true);
    }


    // Actions

    public function get(string $key, $default = null, $strict = false)
    {
        if( $strict ) {
            return isset($this->data_array[$key]) &&! empty($this->data_array[$key]) ? $this->data_array[$key] : $default;
        }

        return array_key_exists($key, $this->data_array) ? $this->data_array[$key] : $default;
    }


    // Statics

    public static function singleton()
    {
        if( is_null(self::$singleton) ) {
            self::$singleton = self::first();
        }

        return self::$singleton;
    }
}
