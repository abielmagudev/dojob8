<?php

namespace App\Models;

use App\Models\Kernel\Traits\HasHookUsers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;
    use HasHookUsers;

    protected $table = 'configuration';

    protected $fillable = [
        'data_json',
        'created_by',
        'updated_by',
    ];

    
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
}
