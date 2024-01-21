<?php

namespace App\Http\Requests;

use App\Http\Requests\WorkOrderRequest\ResolveExtensionRequestsTrait;
use App\Models\Client;
use App\Models\Contractor;
use App\Models\Crew;
use App\Models\Job;
use App\Models\WorkOrder;
use Illuminate\Foundation\Http\FormRequest;

class WorkOrderStoreRequest extends FormRequest
{
    use ResolveExtensionRequestsTrait;

    public $work_order_ids_to_bind = [
        'rework' => '',
        'warranty' => '',
    ];

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'client' => [
                'required',
                sprintf('exists:%s,id', Client::class),
            ],
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
            'job' => [
                'required',
                sprintf('exists:%s,id', Job::class),
            ],
            'crew' => [
                'required', 
                sprintf('in:%s', Crew::forWorkOrders()->get()->pluck('id')->implode(',')),
            ],
            'contractor' => [
                'nullable',
                sprintf('exists:%s,id', Contractor::class),
            ],
            'notes' => [
                'nullable',
                'string',
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
        if(! WorkOrder::getNonDefaultTypes()->contains( $this->get('type') ) ) {
            return;
        }

        if(! $client = Client::find( $this->get('client') ) ) {
            return;
        }

        $this->work_order_ids_to_bind[ $this->get('type') ] = $this->get('type') == 'rework' 
            ? $client->work_orders_for_rework->pluck('id')->implode(',')
            : $client->work_orders_for_warranty->pluck('id')->implode(',');
    }

    public function passedValidation()
    {
        $job = Job::find($this->job);

        $this->merge([
            'cache' => [
                'extensions' => $job->extensions,
                'resolved_requests' => $this->resolveExtensionRequests(
                    $job->extensions,
                    'store'
                ),
            ],
        ]);
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'rework_id' => $this->get('type') == 'rework' ? $this->get('rework') : null,
            'warranty_id' => $this->get('type') == 'warranty' ? $this->get('warranty') : null,
            'client_id' => $this->client,
            'contractor_id' => $this->contractor,
            'job_id' => $this->job,
            'crew_id' => $this->crew,
            'status' => WorkOrder::INITIAL_STATUS,
        ]);
    }
}
