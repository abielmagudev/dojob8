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
            ],
            'warranty' => [
                'required_if:type,warranty',
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
            ],
        ];
    }

    public function messages()
    {
        return [
            'rework.required_if' => __('Choose some work order for rework'),
            'warranty.required_if' => __('Choose some work order for warranty'),
        ];
    }

    public function prepareForValidation()
    {
        if( 
            WorkOrder::getTypesNonDefault()->contains( $this->get('type') ) &&
            $client = Client::find( $this->get('client') ) 
        ) {
            return;
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
            'rework_id' => $this->filled('rework') ? $this->get('rework') : null,
            'warranty_id' => $this->filled('warranty') ? $this->get('warranty') : null,
            'client_id' => $this->client,
            'contractor_id' => $this->contractor,
            'job_id' => $this->job,
            'crew_id' => $this->crew,
            'status' => WorkOrder::INITIAL_STATUS,
        ]);
    }
}
