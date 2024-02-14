<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
        'work_order_id',
    ];

    protected $casts = [
        'created_at',
    ];


    public function getCreatedDateHumanAttribute()
    {
        return $this->created_at->format('d M, Y');
    }

    public function getCreatedTimeHumanAttribute()
    {
        return $this->created_at->format('g:i A');
    }


    // Relationships

    public function work_order()
    {
        return $this->belongsTo(WorkOrder::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
