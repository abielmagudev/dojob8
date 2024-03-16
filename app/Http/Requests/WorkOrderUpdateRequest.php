<?php

namespace App\Http\Requests;

use App\Models\Contractor;
use App\Models\Crew;
use App\Models\WorkOrder\Kernel\WorkOrderTypeCatalog;
use App\Models\WorkOrder\Kernel\WorkOrderStatusCatalog;
use Illuminate\Foundation\Http\FormRequest;

class WorkOrderUpdateRequest extends FormRequest
{
    public $crews_id;

    public $work_orders_id_to_rectify = '';

    public function authorize()
    {
        return auth()->user()->can('edit-work-orders');
    }

    public function prepareForValidation()
    {
        $work_order = $this->route('work_order');

        $this->crews_id = Crew::purposeWorkOrders()->get()->push($work_order->crew)->pluck('id')->implode(',');

        if( WorkOrderTypeCatalog::rectification()->contains($this->type) ) {
            $this->work_orders_id_to_rectify = $work_order->client->work_orders_to_rectify->pluck('id')->implode(',');
        }
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
                sprintf('in:%s', WorkOrderTypeCatalog::all()->implode(',')),
            ],
            'rectification_id' => [
                'sometimes',
                sprintf('required_if:type,%s', WorkOrderTypeCatalog::rectification()->implode(',')),
                sprintf('in:%s', $this->work_orders_id_to_rectify),
            ],
            'crew' => [
                'nullable', 
                'sometimes',
                sprintf('in:%s', $this->crews_id),
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
                'required_with:working_time',
                'date',
            ],
            'working_time' => [
                'nullable',
                'required_with:working_date',
                'date_format:H:i',
            ],
            'done_date' => [
                'nullable',
                'required_with:done_time',
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
                sprintf('in:%s', WorkOrderStatusCatalog::all()->implode(','))
            ],
        ];
    }

    public function messages()
    {
        return [
            'rectification_id.required_if' => __(sprintf('Choose a work order for %s', $this->get('type'))),
            'rectification_id.in' => __(sprintf('Choose a valid work order for %s', $this->get('type'))),
        ];
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'type' => $this->get('type'),
            'rectification_id' => WorkOrderTypeCatalog::rectification()->contains($this->type) ? $this->get('rectification_id') : null,
            'contractor_id' => $this->get('contractor'),
            'crew_id' => $this->get('crew'),
            'working_at' => collect($this->only(['working_date', 'working_time']))->filter()->implode(' '), // Mutator
            'done_at' => collect($this->only(['done_date', 'done_time']))->filter()->implode(' '), // Mutator
            'completed_at' => $this->get('status'), // Mutator
            'status' => $this->get('status'),
        ]);
    }
}
