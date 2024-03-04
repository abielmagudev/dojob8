<?php 

namespace App\Models\Inspection\Services;

use App\Models\Inspection;

class InspectionCrewMemberService
{
    protected $inspection;

    public function __construct(Inspection $inspection)
    {
        $this->inspection = $inspection;
    }

    public function attach()
    {
        if( $members = $this->getCrewMembers() ) {
            $this->inspection->members()->attach( $members );
        }

        return $this;
    }

    public function detach()
    {
        $this->inspection->members()->detach();

        return $this;
    }

    public function sync()
    {
        $this->inspection->members()->sync( ($this->getCrewMembers() ?? []) );

        return $this;
    }

    public function syncWithoutDetaching()
    {
        if( $members = $this->getCrewMembers() ) {
            $this->inspection->members()->syncWithoutDetaching( $members );
        }

        return $this;
    }

    public function detachWhenNoHasCrew()
    {
        if(! $this->inspection->hasCrew() ) {
            $this->detach();
        }

        return $this;
    }

    public function getCrewMembers()
    {
        return $this->inspection->hasCrew() ? $this->inspection->crew->members : null;
    }
}
