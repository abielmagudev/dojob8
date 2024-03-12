<?php

namespace App\Xapis\Stock\BattInsulation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BattInsulationWorkOrder extends Model
{
    use HasFactory;

    protected $table = 'xapi_battins_work_orders';

    protected $fillable = [
        'area',
        'rvalue_name',
        // 'rvalue_score',
        'size',
        'type',
        'square_footage',
        'square_footage_netting',
        'work_order_id',
    ];
}
