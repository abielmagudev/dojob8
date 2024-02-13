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
        return true;
    }

    public function rules()
    {
        return [
            'scheduled_date' => [
                'required',
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
            'rework.required_if' => __('Choose a work order for rework'),
            'rework.in' => __('Choose a work order valid for rework'),
            'warranty.required_if' => __('Choose a work order for warranty'),
            'warranty.in' => __('Choose a work order valid for warranty'),
        ];
    }

    public function prepareForValidation()
    {
        $work_order = $this->route('work_order');

        $this->crew_ids = Crew::taskWorkOrders()->get()->push($work_order->crew)->pluck('id')->implode(',');

        if( WorkOrder::getAllTypes()->contains( $this->get('type') ) && $this->get('type') <> 'standard' ) {
            $this->work_order_ids_for_rectification = $work_order->client->onlyWorkOrdersForRectification()->pluck('id')->implode(',');
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
            'rework_id' => $this->get('type') == 'rework' ? $this->get('rework') : null,
            'warranty_id' => $this->get('type') == 'warranty' ? $this->get('warranty') : null,
            'contractor_id' => $this->contractor,
            'crew_id' => $this->crew,
            'working_at' => $this->only(['working_date', 'working_time']), // Mutator
            'done_at' => $this->only(['done_date', 'done_time']), // Mutator
            'completed_at' => $this->get('status'), // Mutator
        ]);
    }
}
