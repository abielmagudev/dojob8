<?php

namespace App\Models;

use App\Models\Kernel\FilteringInterface;
use App\Models\Kernel\HasFilteringTrait;
use Illuminate\Database\Eloquent\Model;

class History extends Model implements FilteringInterface
{
    use HasFilteringTrait;

    protected $table = 'history';
    
    public $timestamps = false;

    protected $fillable = [
        'description',
        'link',
        'model_type',
        'model_id',
        'user_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public static $topics_classnames = [
        'clients' => Client::class,
        'contractor' => Contractor::class,
        'crews' => Crew::class,
        'extensions' => Extension::class,
        'inspections' => Inspection::class,
        'inspector' => Inspector::class,
        'jobs' => Job::class,
        'staff' => Member::class,
        'users' => User::class,
        'work orders' => WorkOrder::class,
    ];

    
    // Interface

    public function inputsAndFilters(): array
    {
        return [
            'from_date' => ['filterCreatedBetween', 'to_date'],
            'topic' => 'filterTopic',
            'user' => 'filterUser',
        ];
    }
    

    // Attributes

    public function getCreatedDateHumanAttribute()
    {
        return $this->created_at->format('D d, M Y'); 
    }

    public function getCreatedTimeHumanAttribute()
    {
        return $this->created_at->format('h:m A'); 
    }


    // Validators

    public function hasLink()
    {
        return ! empty($this->link);
    }



    // Scopes

    public function scopeWhereModel($query, string $classname, $id)
    {
        return $query->where('model_type', $classname)->where('model_id', $id);
    }

    public function scopeWhereNotModel($query, string $classname, $id)
    {
        return $query->where('model_type', '<>', $classname)->where('model_id', '<>', $id);
    }

    public function scopeWhereModelType($query, string $classname)
    {
        return $query->where('model_type', $classname);
    }

    public function scopeWhereNotModelType($query, string $classname)
    {
        return $query->where('model_type', '<>',$classname);
    }

    public function scopeWhereUser($query, $id)
    {
        return $query->where('user_id', $id);
    }

    public function scopeWhereNotUser($query, $id)
    {
        return $query->where('user_id', '<>', $id);
    }

    public function scopeWhereHasLink($query)
    {
        return $query->whereNotNull('link');
    }

    public function scopeWhereNotHasLink($query)
    {
        return $query->whereNull('link');
    }

    public function scopeWhereCreatedFrom($query, string $date)
    {
        return $query->whereDate('created_at', '>=', $date);
    }

    public function scopeWhereCreatedTo($query, string $date)
    {
        return $query->whereDate('created_at', '<=', $date);
    }

    public function scopeWhereCreatedBetween($query, array $from_to_dates)
    {
        return $query->whereBetween('created_at', $from_to_dates);
    }



    // Filters

    public function scopeFilterCreatedBetween($query, string $from_date = null, string $to_date = null)
    {
        // Both From and To
        if( isset($from_date) && isset($to_date) ) {
            return $query->whereCreatedBetween([$from_date, $to_date]);
        }
        
        // Only From
        if( isset($from_date) &&! isset($to_date) ) {
            return $query->whereCreatedFrom($from_date);
        }

        // Only To
        if(! isset($from_date) && isset($to_date) ) {
            return $query->whereCreatedTo($to_date);
        }

        return $query;
    }

    public function scopeFilterTopic($query, $topic)
    {
        if( is_null($topic) ) {
            return $query;
        }

        $classname = self::getClassnameByTopic($topic);

        return $query->whereModelType($classname);
    }

    public function scopeFilterUser($query, $user_id)
    {
        if( is_null($user_id) ) {
            return $query;
        }

        return $query->whereUser($user_id);
    }



    // Relationships

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function model()
    {
        return $this->morphTo(__FUNCTION__, 'model_type', 'model_id');
    }


    
    // Static

    public static function getTopicsClassnames()
    {
        return self::$topics_classnames;
    }

    public static function getTopics()
    {
        return array_keys( self::getTopicsClassnames() );
    }

    public static function exitsTopic(string $topic)
    {
        return array_key_exists($topic, self::getTopicsClassnames());
    }

    public static function getClassnameByTopic($topic)
    {
        return self::exitsTopic($topic) ? self::getTopicsClassnames()[$topic] : null;
    }



    // Hooks

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = $model->freshTimestamp();
        });
    }
}
