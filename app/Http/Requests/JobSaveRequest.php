<?php

namespace App\Http\Requests;

use App\Models\Agency;
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
            'approved_inspections_required_count' => [
                'required',
                'integer',
                'min:0',
            ],
            'agencies_generate_inspections' => [
                'nullable',
                'array',
            ],
            'agencies_generate_inspections.*' => [
                sprintf('in:%s', Agency::all()->pluck('id')->implode(','))
            ],
        ];
    }

    public function messages()
    {
        return [
            'agencies_generate_inspections.array' => __('Choose one agency of the list'),
            'agencies_generate_inspections.*.in' => __('Choose a valid agency'),
            'approved_inspections_required_count.required' => __('Enter the number of approved inspections required'),
            'approved_inspections_required_count.integer' => __('Enter the valid number of approved inspections required'),
            'approved_inspections_required_count.min' => __('If it does not require approved inspections, enter zero(0'),
        ];
    }

    public function prepareForValidation()
    {
        $this->job_id = $this->route('job')->id ?? 0;
    }

    public function validated()
    {
        $validated = parent::validated();

        if( in_array($this->method(), ['PATCH','PUT']) ) {
            $validated['is_active'] = $this->has('active') ? 1 : 0;
        }

        if( $this->filled('agencies_generate_inspections') ) {
            $validated['agencies_generate_inspections_json'] = json_encode( $this->get('agencies_generate_inspections') );
        }

        return $validated;
    }
}
