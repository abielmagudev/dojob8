<?php

namespace App\Models;

use App\Models\Product\Traits\BelongsProducts;
use App\Models\History\Traits\HasHistory;
use App\Models\Kernel\Traits\BelongsCreatorUser;
use App\Models\Kernel\Traits\BelongsDeleterUser;
use App\Models\Kernel\Traits\BelongsUpdaterUser;
use App\Models\Kernel\Traits\HasActiveStatus;
use App\Models\WorkOrder\Traits\HasWorkOrders;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use BelongsCreatorUser;
    use BelongsDeleterUser;
    use BelongsUpdaterUser;
    use BelongsProducts;
    use HasActiveStatus;
    use HasFactory;
    use HasHistory;
    use HasWorkOrders;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'success_inspections_required_count',
        'is_active',
    ];


    // Accesors

    public function getInspectionSetupCounterAttribute()
    {
        return ($this->inspection_setup_count || $this->inspection_setup->count());
    }


    // Validators

    public function requiresSuccessInspections(): bool
    {
        return (bool) $this->success_inspections_required_count;
    }

    public function hasInspectionSetup(): bool
    {
        return (bool) $this->inspection_setup_counter;
    }


    // Relationships

    public function inspection_setup()
    {
        return $this->hasMany(InspectionSetupForJob::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
