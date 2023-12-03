<?php

namespace App\Http\Requests;

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
            'notes' => [
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
            'inspector_id' => $this->inspector,
            'is_approved' => $this->status,
        ]);
    }
}
