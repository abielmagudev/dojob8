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
        'members' => Member::class,
        'users' => User::class,
        'work orders' => WorkOrder::class,
    ];

    
    // Interface

    public function inputFilterSettings(): array
    {
        return [
            'dates' => 'filterByCreatedBetween',
            'topic' => 'filterByTopic',
            'user' => 'filterByUser',
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

    public function scopeWhereCreatedFrom($query, string $value)
    {
        return $query->whereDate('created_at', '>=', $value);
    }

    public function scopeWhereCreatedTo($query, string $value)
    {
        return $query->whereDate('created_at', '<=', $value);
    }

    public function scopeWhereCreatedBetween($query, array $values)
    {
        return $query->whereBetween('created_at', $values);
    }


    // Filters

    public function scopeFilterByCreatedBetween($query, array $dates)
    {
        // Both From and To
        if( isset($dates['from'], $dates['to']) ) {
            return $query->whereCreatedBetween([$dates['from'], $dates['to']]);
        }
        
        // Only From
        if( isset($dates['from']) &&! isset($dates['to']) ) {
            return $query->whereCreatedFrom($dates['from']);
        }

        // Only To
        if(! isset($dates['from']) && isset($dates['to']) ) {
            return $query->whereCreatedTo($dates['to']);
        }

        return $query;
    }

    public function scopeFilterByTopic($query, $topic)
    {
        if( is_null($topic) ) {
            return $query;
        }

        $classname = self::getClassnameByTopic($topic);

        return $query->whereModelType($classname);
    }

    public function scopeFilterByUser($query, $user_id)
    {
        return ! is_null($user_id) ? $query->whereUser($user_id) : $query;
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

    public static function existsTopic(string $topic)
    {
        return array_key_exists($topic, self::getTopicsClassnames());
    }

    public static function getClassnameByTopic($topic)
    {
        return self::existsTopic($topic) ? self::getTopicsClassnames()[$topic] : null;
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
