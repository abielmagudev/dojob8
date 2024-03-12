<?php

namespace App\Http\Requests;

use App\Models\Assessment\Kernel\StatusCatalog;
use App\Models\Client;
use App\Models\Contractor;
use Illuminate\Foundation\Http\FormRequest;

class AssessmentStoreRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('create-assessments');
    }

    public function rules()
    {
        return [
            'client' => [
                'bail',
                'required',
                'integer',
                sprintf('exists:%s,id', Client::class),
            ],
            'contractor' => [
                'bail',
                'required',
                'integer',
                sprintf('exists:%s,id', Contractor::class),
            ],
            'scheduled_date' => [
                'required',
                'date',
            ],
            'notes' => [
                'nullable',
                'string',
            ],
        ];
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'client_id' => $this->client,
            'contractor_id' => $this->contractor,
            'status' => StatusCatalog::INITIAL,
        ]);
    }
}
