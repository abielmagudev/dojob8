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

    public $work_order_ids_to_bind = [
        'rework' => '',
        'warranty' => '',
    ];

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
            'rework' => [
                'required_if:type,rework',
                sprintf('in:%s', $this->work_order_ids_to_bind['rework']),
            ],
            'warranty' => [
                'required_if:type,warranty',
                sprintf('in:%s', $this->work_order_ids_to_bind['warranty']),
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

        $this->crew_ids = Crew::forWorkOrders()->get()->push($work_order->crew)->pluck('id')->implode(',');

        if(! WorkOrder::getNonDefaultTypes()->contains( $this->get('type') ) ) {
            return;
        }

        $work_orders_to_bind = $this->get('type') == 'rework' 
                            ? $work_order->client->work_orders_for_rework
                            : $work_order->client->work_orders_for_warranty;

        if( $work_order->isType( $this->get('type') ) &&! $work_orders_to_bind->contains($work_order->bound_id) ) {
            $work_orders_to_bind->push($work_order->bound);
        }

        $this->work_order_ids_to_bind[ $this->get('type') ] = $work_orders_to_bind->pluck('id')->implode(',');
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
        ]);
    }
}
