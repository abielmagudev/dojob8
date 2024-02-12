<?php

namespace App\Http\Requests;

use App\Models\Agency;
use App\Models\Crew;
use App\Models\Inspection;
use App\Models\WorkOrder;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class InspectionSaveRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'scheduled_date' => [
                'nullable',
                'date',
            ],
            'agency' => [
                'bail',
                'required',
                'integer',
                sprintf('exists:%s,id,is_active,1', Agency::class),
            ],
            'inspector_name' => [
                'nullable',
                'string',
            ],
            'observations' => [
                'nullable',
                'string',
            ],
            'crew' => [
                'bail',
                'nullable',
                'integer',
                sprintf('in:%s', Crew::taskInspections()->get()->pluck('id')->implode(',')),
            ],
            'status' => [
                'required',
                sprintf('in:%s', Inspection::allStatuses()->implode(',')),
            ],
            'work_order' => [
                'bail', 
                'required', 
                'integer', 
                sprintf('exists:%s,id', WorkOrder::class),
            ],
        ];

        if(! $this->isMethod('POST') ) {
            unset($rules['work_order']);
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'work_order.*' => __('Do not try to manipulate the data outside of the application methods.'),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if( $validator->errors()->has('work_order') )
        {
            throw new HttpResponseException(
                $this->redirector->to( route('work-orders.index') )
                    ->withErrors($validator)
                    ->with('danger', $validator->errors()->first('work_order'))
            );
        } 
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'agency_id' => $this->get('agency'),
            'crew_id' => $this->get('crew'),
            'status' => $this->get('status'),
            'work_order_id' => $this->isMethod('POST') ? $this->work_order : $this->route('inspection')->work_order_id,
        ]);
    }
}
