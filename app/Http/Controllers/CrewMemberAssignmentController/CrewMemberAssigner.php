<?php

namespace App\Http\Controllers\CrewMemberAssignmentController;

use Illuminate\Database\Eloquent\Collection;

class CrewMemberAssigner
{
    public static function update(Collection $models, bool $keep_crew_members_saved)
    {
        $result = $keep_crew_members_saved 
                ? self::add($models) 
                : self::replace($models);

        return collect($result);
    }

    public static function add(Collection $models)
    {
        $result = [];

        foreach($models as $model)
        {
            $result[$model->id] = $model->members()->syncWithoutDetaching(
                $model->crew->members
            );
        }

        return $result;
    }

    public static function replace(Collection $models)
    {
        $result = [];

        foreach($models as $model)
        {
            $result[$model->id] = $model->members()->sync(
                $model->crew->members
            );
        }

        return $result;
    }
}
