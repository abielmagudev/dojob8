<?php

namespace App\Http\Requests;

use App\Models\Assessment;
use App\Models\Client;
use App\Models\Contractor;
use App\Models\Crew;
use App\Models\Job;
use App\Models\WorkOrder\Kernel\WorkOrderTypeCatalog;
use App\Models\WorkOrder\Kernel\WorkOrderStatusCatalog;
use Illuminate\Foundation\Http\FormRequest;

class WorkOrderStoreRequest extends FormRequest
{
    public $work_orders_id_to_rectify = '';

    public function authorize()
    {
        return auth()->user()->can('create-work-orders');
    }

    public function prepareForValidation()
    {
        if( WorkOrderTypeCatalog::rectification()->contains($this->type) && $client = Client::find($this->client) ) {
            $this->work_orders_id_to_rectify = $client->work_orders_to_rectify->pluck('id')->implode(',');
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
                sprintf('in:%s', WorkOrderTypeCatalog::all()->implode(',')),
            ],
            'rectification_id' => [
                'sometimes',
                sprintf('required_if:type,%s', WorkOrderTypeCatalog::rectification()->implode(',')),
                sprintf('in:%s', $this->work_orders_id_to_rectify),
            ],
            'job' => [
                'required',
                sprintf('exists:%s,id', Job::class),
            ],
            'crew' => [
                'nullable', 
                sprintf('in:%s', Crew::task('work orders')->get()->pluck('id')->implode(',')),
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
            'assessment' => [
                'sometimes',
                'nullable',
                sprintf('exists:%s,id', Assessment::class),
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
            'rectification_id' => $this->get('rectification_id'),
            'client_id' => $this->get('client'),
            'contractor_id' => $this->get('contractor'),
            'job_id' => $this->get('job'),
            'crew_id' => $this->get('crew'),
            'status' => WorkOrderStatusCatalog::INITIAL,
            'assessment_id' => $this->filled('assessment') ? $this->assessment : null,
        ]);
    }
}
