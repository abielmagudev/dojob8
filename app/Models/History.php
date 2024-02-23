<?php

namespace App\Models;

use App\Models\Kernel\Interfaces\Filterable;
use App\Models\Kernel\Traits\HasFiltering;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class History extends Model implements Filterable
{
    use HasFiltering;

    protected $table = 'history';
    
    protected $fillable = [
        'description',
        'link',
        'model_type',
        'model_id',
        'user_id',
        'created_at'
    ];

    public static $topics_classnames = [
        'agencies' => Agency::class,
        'clients' => Client::class,
        'contractor' => Contractor::class,
        'crews' => Crew::class,
        'inspections' => Inspection::class,
        'jobs' => Job::class,
        'members' => Member::class,
        'settings' => Settings::class,
        'users' => User::class,
        'work orders' => WorkOrder::class,
        // 'extensions' => Extension::class,
    ];

    
    // Interface

    public function getParameterFilterSettings(): array
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
        return Carbon::parse($this->created_at)->format('D d, M Y'); 
    }

    public function getCreatedTimeHumanAttribute()
    {
        return Carbon::parse($this->created_at)->format('g:i A'); 
    }


    // Validators

    public function hasLink()
    {
        return filter_var($this->link, FILTER_VALIDATE_URL);
    }


    // Scopes

    public function scopeAbout($query, Model $model)
    {
        return $query->where('model_type', get_class($model))->where('model_id', $model->id);
    }

    public function scopeCreatedBetween($query, array $values)
    {
        return $query->whereBetween('created_at', $values);
    }

    public function scopeCreatedFrom($query, string $value)
    {
        return $query->whereDate('created_at', '>=', $value);
    }

    public function scopeCreatedTo($query, string $value)
    {
        return $query->whereDate('created_at', '<=', $value);
    }


    // Filters

    public function scopeFilterByCreatedBetween($query, array $dates)
    {
        // Both From and To
        if( isset($dates['from'], $dates['to']) ) {
            return $query->createdBetween([$dates['from'], $dates['to']]);
        }
        
        // Only From
        if( isset($dates['from']) &&! isset($dates['to']) ) {
            return $query->createdFrom($dates['from']);
        }

        // Only To
        if(! isset($dates['from']) && isset($dates['to']) ) {
            return $query->createdTo($dates['to']);
        }

        return $query;
    }

    public function scopeFilterByTopic($query, $topic)
    {
        if( is_null($topic) ) {
            return $query;
        }

        return $query->where('model_type', self::getClassnameByTopic($topic));
    }

    public function scopeFilterByUser($query, $user_id)
    {
        return ! is_null($user_id) ? $query->where('user_id', $user_id) : $query;
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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (Auth::check()) {
                $model->user_id = Auth::id();
            }
        });
    }
}
