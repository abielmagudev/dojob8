<?php 

namespace App\Http\Controllers\DashboardController\Responses\AdminResponse;

use App\Models\Agency;
use App\Models\Contractor;
use App\Models\Crew;
use App\Models\Inspection;
use App\Models\Job;
use App\Models\User;
use App\Models\WorkOrder;
use App\Models\WorkOrder\Kernel\WorkOrderStatusCatalog;
use Illuminate\Http\Request;

class StatisticalDataGenerator
{
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function dataByDefault(): array
    {
        return [
            'all_statuses_work_order' => WorkOrderStatusCatalog::all(),
            'all_statuses_inspection' => InspectionStatusCatalog::all(),
            'agencies' => Agency::all(),
            'contractors' => Contractor::all(),
            'jobs' => Job::withTrashed()->get(),
            'user' => User::all(),
            'crews' => Crew::all(),
        ];
    } 

    public function dataByRequest(): array
    {
        $work_orders = $this->getWorkOrders();

        return [
            'work_orders' => $work_orders,
            'inspections' => $work_orders->pluck('inspections')->flatten(),
            'subtitle' => $this->generateSubtitle(),
        ];
    }

    public function getWorkOrders()
    {
        $query = WorkOrder::with([
            'inspections',
            'job.extensions',
        ]);

        if( $this->request->filled('from') && $this->request->filled('to') ) {
            $query->whereBetween('scheduled_date', $this->request->only(['from','to']) );
        }
        elseif( $this->request->filled('from') &&! $this->request->filled('to') ) {
            $query->where('scheduled_date', '>', $this->request->get('from'));
        }
        else {
            $query->where('scheduled_date', '<', $this->request->get('to'));
        }

        return $query->get();
    }

    public function generateSubtitle()
    {
        if( $this->request->filled('from') &&! $this->request->filled('to') ) {
            return sprintf('From %s', humanDateFormat( $this->request->get('from') ));
        }

        if(! $this->request->filled('from') && $this->request->filled('to') ) {
            return sprintf('To %s', humanDateFormat( $this->request->get('to') ));
        }

        return sprintf('Between %s and %s', 
            humanDateFormat( $this->request->get('from') ),
            humanDateFormat( $this->request->get('to') )
        );
    }
}
