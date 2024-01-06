<?php

namespace App\Http\Requests;

use App\Http\Requests\WorkOrderRequest\ResolveExtensionRequestsTrait;
use App\Models\Contractor;
use App\Models\Crew;
use App\Models\WorkOrder;
use Illuminate\Foundation\Http\FormRequest;

class WorkOrderUpdateRequest extends FormRequest
{    
    use ResolveExtensionRequestsTrait;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'scheduled_date' => [
                'required',
                'date',
            ],
            'contractor' => [
                'nullable',
                sprintf('exists:%s,id', Contractor::class),
            ],
            'crew' => [
                'required', 
                sprintf('in:%s', Crew::forWorkOrders()->get()->pluck('id')->implode(',')),
            ],
            'notes' => [
                'nullable',
            ],
            'status' => [
                'required',
                'string',
                sprintf('in:%s', WorkOrder::getAllStatuses()->implode(','))
            ],
        ];
    }

    public function passedValidation()
    {
        $this->merge([
            'cache' => [
                'extensions' => $this->route('work_order')->job->extensions,
                'resolved_requests' => $this->resolveExtensionRequests(
                    $this->route('work_order')->job->extensions,
                    'update'
                ),
            ],
        ]);
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'contractor_id' => $this->contractor,
            'crew_id' => $this->crew,
        ]);
    }
}
