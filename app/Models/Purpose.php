<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purpose extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'crew_id',
    ];

    protected static $all_names = [
        'inspections',
        'work orders',
    ];


    // Statics 

    public static function collectionAllNames()
    {
        return collect(self::$all_names);
    }
}
