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

    public $work_order_ids_for_rectification = '';

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
            'type_id' => [
                'required_if:type,rework,warranty',
                sprintf('in:%s', $this->work_order_ids_for_rectification),
            ],
            'job' => [
                'required',
                sprintf('exists:%s,id', Job::class),
            ],
            'crew' => [
                'required', 
                sprintf('in:%s', Crew::taskWorkOrders()->get()->pluck('id')->implode(',')),
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
            'type_id.required_if' => __(sprintf('Choose a work order for %s', $this->get('type'))),
            'type_id.in' => __(sprintf('Choose a valid work order for %s', $this->get('type'))),
        ];
    }

    public function prepareForValidation()
    {
        if(! WorkOrder::getAllTypes()->contains($this->get('type')) ) {
            return;
        }

        if( $this->get('type') <> 'standard' && $client = Client::find( $this->get('client') ) ) {
            $this->work_order_ids_for_rectification = $client->onlyWorkOrdersForRectification()->pluck('id')->implode(',');
        }
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
            'payment_status' => WorkOrder::initialPaymentStatus(),
            'inspection_status' => WorkOrder::initialInspectionStatus(),
            'rework_id' => $this->get('type') == 'rework' ? $this->get('type_id') : null,
            'warranty_id' => $this->get('type') == 'warranty' ? $this->get('type_id') : null,
            'client_id' => $this->client,
            'contractor_id' => $this->contractor,
            'job_id' => $this->job,
            'crew_id' => $this->crew,
            'status' => WorkOrder::INITIAL_STATUS,
        ]);
    }
}
