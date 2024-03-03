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
        if( $members = $this->crew_members() ) {
            $this->inspection->members()->attach( $members );
        }

        return $this;
    }

    public function detach()
    {
        $members = $this->crew_members();

        $this->inspection->members()->detach( $members );

        return $this;
    }

    public function detachForce()
    {
        $this->inspection->members()->detach();

        return $this;
    }

    public function sync()
    {
        $this->inspection->members()->sync( ($this->crew_members() ?? []) );

        return $this;
    }

    public function syncWithoutDetaching()
    {
        if( $members = $this->crew_members() ) {
            $this->inspection->members()->syncWithoutDetaching( $members );
        }

        return $this;
    }

    public function crew_members()
    {
        return $this->inspection->hasCrew() ? $this->inspection->crew->members : null;
    }

    public function detachForceWhenNoCrew()
    {
        if(! $this->inspection->hasCrew() ) {
            $this->detachForce();
        }

        return $this;
    }
}
