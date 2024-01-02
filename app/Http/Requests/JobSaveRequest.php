<?php

namespace App\Http\Requests;

use App\Models\Inspector;
use App\Models\Job;
use Illuminate\Foundation\Http\FormRequest;

class JobSaveRequest extends FormRequest
{
    public $job_id;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                sprintf('unique:%s,name,%s', Job::class, $this->job_id),
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'preconfigured_required_inspections' => [
                'nullable',
                'array',
            ],
            'preconfigured_required_inspections.*' => [
                sprintf('in:%s', Inspector::all()->pluck('id')->implode(','))
            ],
        ];
    }

    public function messages()
    {
        return [
            'extensions.*.integer' => __('Choose a valid extension'),
            'preconfigured_required_inspections.array' => __('Select one of the inspectors shown'),
            'preconfigured_required_inspections.*.in' => __('Choose a valid inspector'),
        ];
    }

    public function prepareForValidation()
    {
        $this->job_id = $this->route('job')->id ?? 0;
    }

    public function validated()
    {
        $validated = parent::validated();

        if( $this->filled('preconfigured_required_inspections') ) {
            $validated['preconfigured_required_inspections'] = json_encode( $this->get('preconfigured_required_inspections') );
        }

        if( in_array($this->method(), ['PATCH', 'PUT']) ) {
            $validated['is_available'] = $this->has('available') ? 1 : 0;
        }

        return $validated;
    }
}
