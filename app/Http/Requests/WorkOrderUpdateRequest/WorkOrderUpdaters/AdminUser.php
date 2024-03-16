<?php

namespace App\Http\Requests\WorkOrderUpdateRequest\WorkOrderUpdaters;

use App\Http\Requests\WorkOrderUpdateRequest\WorkOrderUpdaters\Kernel\Updater;
use App\Models\Contractor;
use App\Models\Crew;
use App\Models\WorkOrder;
use App\Models\WorkOrder\Kernel\WorkOrderStatusCatalog;
use App\Models\WorkOrder\Kernel\WorkOrderTypeCatalog;

class AdminUser extends Updater
{

    public $work_orders_id_for_rectification;

    public function prepareForValidation()
    {
        $work_order = $this->request->route('work_order');

        $this->crews_id = Crew::purposeWorkOrders()->get()->push($work_order->crew)->pluck('id')->implode(',');

        if( WorkOrderTypeCatalog::all()->contains( $this->request->get('type') ) && $this->request->get('type') <> 'standard' ) {
            $this->work_orders_id_for_rectification = $work_order->client->onlyWorkOrdersForRectification($work_order)->pluck('id')->implode(',');
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
                sprintf('required_if:type,%s', WorkOrderTypeCatalog::rectification()->implode(',')),
                sprintf('in:%s', $this->work_orders_id_for_rectification),
            ],
            'crew' => [
                'nullable', 
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
            'rectification_id.required_if' => __(sprintf('Choose a work order for %s', $this->request->get('type'))),
            'rectification_id.in' => __(sprintf('Choose a valid work order for %s', $this->request->get('type'))),
        ];
    }

    public function validated()
    {
        return [
            'type' => $this->request->get('rectification_id') ? $this->request->get('type') : null,
            'rectification_id' => $this->request->get('rectification_id'),
            'contractor_id' => $this->request->get('contractor'),
            'crew_id' => $this->request->get('crew'),
            'working_at' => $this->request->only(['working_date', 'working_time']), // Mutator
            'done_at' => $this->request->only(['done_date', 'done_time']), // Mutator
            'completed_at' => $this->request->get('status'), // Mutator
            'status' => $this->request->get('status'),
        ];
    }
}
