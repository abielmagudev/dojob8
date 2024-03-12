<?php

namespace App\Http\Requests;

use App\Models\Assessment\Kernel\StatusCatalog;
use App\Models\Contractor;
use Illuminate\Foundation\Http\FormRequest;

class AssessmentUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('edit-assessments');
    }

    public function rules()
    {
        return [
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
            'status' => [
                'required',
                sprintf('in:%s', StatusCatalog::all()->implode(','))
            ],
        ];
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'contractor_id' => $this->contractor,
        ]);
    }
}
