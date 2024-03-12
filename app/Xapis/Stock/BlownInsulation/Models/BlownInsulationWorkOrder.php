<?php

namespace App\Xapis\Stock\BlownInsulation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlownInsulationWorkOrder extends Model
{
    use HasFactory;

    protected $table = 'xapi_blownins_work_orders';

    protected $fillable = [
        'area',
        'rvalue_name',
        'rvalue_score',
        'square_footage',
        'bags',
        'work_order_id',
    ];
}
