<?php

namespace App\Xapis\Stock\BattInsulationMaterial\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BattInsMatWorkOrder extends Model
{
    use HasFactory;

    protected $table = 'xapi_battinsmat_work_orders';

    protected $fillable = [
        'space',
        'rvalue_name',
        'size',
        'type',
        'square_footage',
        'square_footage_netting',
        'work_order_id',
    ];
}
