<?php

namespace App\Http\Requests;

use App\Http\Requests\WorkOrderRequest\ResolveExtensionRequestsTrait;
use App\Models\Client;
use App\Models\Contractor;
use App\Models\Crew;
use App\Models\WorkOrder;
use Illuminate\Foundation\Http\FormRequest;

class WorkOrderUpdateRequest extends FormRequest
{    
    use ResolveExtensionRequestsTrait;

    public $work_order_ids_for_rectification = '';

    public $crew_ids = '';

    public function authorize()
    {
        return auth()->user()->can('edit-work-orders');
    }

    public function rules()
    {
        return [
            'scheduled_date' => [
                'nullable',
                'date',
            ],
            'type' => [
                'required',
                sprintf('in:%s', WorkOrder::getAllTypes()->implode(',')),
            ],
            'type_id' => [
                'required_if:type,rework,warranty',
                sprintf('in:%s', $this->work_order_ids_for_rectification),
            ],
            'crew' => [
                'required', 
                sprintf('in:%s', $this->crew_ids),
            ],
            'contractor' => [
                'nullable',
                sprintf('exists:%s,id', Contractor::class),
            ],
            'permit_code' => [
                'nullable',
                'string',
            ],
            'notes' => [
                'nullable',
            ],
            'working_date' => [
                'nullable',
                'date',
            ],
            'working_time' => [
                'nullable',
                'required_with:working_date',
                'date_format:H:i',
            ],
            'done_date' => [
                'nullable',
                'date',
            ],
            'done_time' => [
                'nullable',
                'required_with:done_date',
                'date_format:H:i',
            ],
            'status' => [
                'required',
                'string',
                sprintf('in:%s', WorkOrder::getAllStatuses()->implode(','))
            ],
        ];
    }

    public function messages()
    {
        return [
            'type_id.required_if' => __(sprintf('Choose a work order for %s', $this->get('type'))),
            'type_id.in' => __(sprintf('Choose a valid work order for %s', $this->get('type'))),
        ];
    }

    public function prepareForValidation()
    {
        $work_order = $this->route('work_order');

        $this->crew_ids = Crew::taskWorkOrders()->get()->push($work_order->crew)->pluck('id')->implode(',');

        if( WorkOrder::getAllTypes()->contains( $this->get('type') ) && $this->get('type') <> 'standard' ) {
            $this->work_order_ids_for_rectification = $work_order->client->onlyWorkOrdersForRectification($work_order)->pluck('id')->implode(',');
        }
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
            'rework_id' => $this->get('type') == 'rework' ? $this->get('type_id') : null,
            'warranty_id' => $this->get('type') == 'warranty' ? $this->get('type_id') : null,
            'contractor_id' => $this->get('contractor'),
            'crew_id' => $this->get('crew'),
            'working_at' => collect($this->only(['working_date', 'working_time']))->filter()->implode(' '), // Mutator
            'done_at' => collect($this->only(['done_date', 'done_time']))->filter()->implode(' '), // Mutator
            'completed_at' => $this->get('status'), // Mutator
            'status' => WorkOrder::qualifyForPendingStatus($this->all()) ? 'pending' : ($this->status == 'pending' ? 'pause' : $this->status),
        ]);
    }
}
