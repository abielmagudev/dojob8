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
            'job' => [
                'required',
                sprintf('exists:%s,id', Job::class),
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
            'client_id' => $this->client,
            'contractor_id' => $this->contractor,
            'job_id' => $this->job,
            'crew_id' => $this->crew,
            'status' => WorkOrder::STATUS_WHEN_CREATED,
        ]);
    }
}
