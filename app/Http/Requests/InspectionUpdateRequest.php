<?php

namespace App\Http\Requests;

use App\Models\Crew;
use App\Models\Inspection;
use App\Models\Inspector;
use Illuminate\Foundation\Http\FormRequest;

class InspectionUpdateRequest extends FormRequest
{
    public $work_order_rules = [];

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
            'crew' => [
                'bail',
                'nullable',
                'integer',
                sprintf('exists:%s,id', Crew::class),
            ],
            'inspector' => [
                'bail',
                'required',
                'integer',
                sprintf('exists:%s,id', Inspector::class),
            ],
            'observations' => [
                'nullable',
                'string',
            ],
            'status' => [
                'numeric',
                sprintf('in:%s', implode(',', Inspection::getStatusValues())),
            ],
        ];
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'crew_id' => $this->crew,
            'inspector_id' => $this->inspector,
            'is_passed' => $this->status,
        ]);
    }
}
