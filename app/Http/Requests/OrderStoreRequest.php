<?php

namespace App\Http\Requests;

use App\Http\Requests\OrderRequest\ResolveExtensionRequestsTrait;
use App\Models\Client;
use App\Models\Job;
use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
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
            'scheduled_time' => [
                'required',
                'date_format:H:i',
            ],
            'job' => [
                'required',
                sprintf('exists:%s,id', Job::class),
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
            'job_id' => $this->job,
        ]);
    }
}
