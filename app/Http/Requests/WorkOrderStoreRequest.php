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

    public $work_orders_id_for_rectification = '';

    public function authorize()
    {
        return auth()->user()->can('create-work-orders');
    }

    public function prepareForValidation()
    {
        if(! WorkOrder::collectionAllTypes()->contains( $this->get('type') ) ) {
            return;
        }

        if( $this->get('type') <> 'standard' && $client = Client::find( $this->get('client') ) ) {
            $this->work_orders_id_for_rectification = $client->onlyWorkOrdersForRectification()->pluck('id')->implode(',');
        }
    }

    public function rules()
    {
        return [
            'client' => [
                'required',
                sprintf('exists:%s,id', Client::class),
            ],
            'scheduled_date' => [
                'nullable',
                'date',
            ],
            'type' => [
                'required',
                sprintf('in:%s', WorkOrder::collectionAllTypes()->implode(',')),
            ],
            'type_id' => [
                sprintf('required_if:type,%s', WorkOrder::collectionAllRectificationTypes()->implode(',')),
                sprintf('in:%s', $this->work_orders_id_for_rectification),
            ],
            'job' => [
                'required',
                sprintf('exists:%s,id', Job::class),
            ],
            'crew' => [
                'nullable', 
                sprintf('in:%s', Crew::purposeWorkOrders()->get()->pluck('id')->implode(',')),
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
                'string',
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
            'rectification_type' => $this->get('type_id') ? $this->get('type') : null,
            'rectification_id' => $this->get('type_id'),
            'client_id' => $this->get('client'),
            'contractor_id' => $this->get('contractor'),
            'job_id' => $this->get('job'),
            'crew_id' => $this->get('crew'),
            'status' => WorkOrder::INITIAL_STATUS,
        ]);
    }
}
