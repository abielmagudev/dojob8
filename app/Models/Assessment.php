<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    const INITIAL_STATUS = 'new';
    
    protected $fillable = [
        'status',
        'scheduled_date',
        'ordered',
        'notes', 
        'client_id',
        'crew_id',
    ];

    protected static $all_statuses = [
        'new',
        'working',
        'done',
    ];
}
