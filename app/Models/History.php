<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class History extends Model
{
    protected $table = 'histories';

    protected $fillable = [
        'description',
        'link',
        'model_type',
        'model_id',
        'user_id',
    ];

    public $timestamps = false;

    public static $topics_classnames = [
        'clients' => Client::class,
        'crews' => Crew::class,
        'extensions' => Extension::class,
        'inspections' => Inspection::class,
        'inspector' => Inspector::class,
        'intermediaries' => Intermediary::class,
        'jobs' => Job::class,
        'work orders' => Order::class,
        'staff' => Member::class,
        'users' => User::class,
    ];

    public static $inputs_filters = [
        'between' => 'filterDoneBetween',
        'topic' => 'filterTopic',
        'user' => 'filterUser',
    ];

    

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

    public function scopeWhereDoneFrom($query, string $date)
    {
        return $query->whereDate('created_at', '>=', $date);
    }

    public function scopeWhereDoneTo($query, string $date)
    {
        return $query->whereDate('created_at', '<=', $date);
    }

    public function scopeWhereDoneBetween($query, array $ranges)
    {
        return $query->whereBetween('created_at', $ranges);
    }



    // Filters

    public function scopeFilterDoneBetween($query, array $ranges)
    {
        // Both From and To
        if( isset($ranges['from']) && isset($ranges['to']) ) {
            return $query->whereDoneBetween($ranges);
        }
        
        // Only From
        if( isset($ranges['from']) &&! isset($ranges['to']) ) {
            return $query->whereDoneFrom($ranges['from']);
        }

        // Only To
        if(! isset($ranges['from']) && isset($ranges['to']) ) {
            return $query->whereDoneTo($ranges['to']);
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

    public function scopeFilters($query, Request $request)
    {
        foreach($request->all() as $input => $value)
        {
            if(! array_key_exists($input, self::$inputs_filters) ) {
                continue;
            }

            $filter = self::$inputs_filters[$input];

            $query = call_user_func([$query, $filter], $value);
        }

        return $query;
    }



    // Relationships

    public function user()
    {
        return $this->belongsTo(User::class);
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
