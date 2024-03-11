<?php

namespace App\Xapis\Stock\CelluloseInsulation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CelluloseInsulationWorkOrder extends Model
{
    use HasFactory;

    protected $table = 'xapi_celluloseins_work_orders';

    protected $fillable = [
        'space',
        'rvalue_name',
        'rvalue_score',
        'square_footage',
        'bags',
        'work_order_id',
    ];
}
