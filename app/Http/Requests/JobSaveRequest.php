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
        return auth()->user()->canAny(['create-jobs', 'edit-jobs']);
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
            'success_inspections_required_count' => [
                'required',
                'integer',
                'min:0',
            ],
            'inpsections_setup' => [
                'sometimes',
                'array'
            ],
            'inpsections_setup.*.agency' => [
                'required_with:inpsections_setup',
                sprintf('in:%s', Agency::all()->pluck('id')->implode(',')),
            ],
        ];
    }

    public function messages()
    {
        return [
            'success_inspections_required_count.integer' => __('Enter the valid number of success inspections required'),
            'success_inspections_required_count.min' => __('If it does not require success inspections, enter zero(0'),
            'success_inspections_required_count.required' => __('Enter the number of success inspections required'),
            'inpsections_setup.array' => __('Use default values to configure'),
            'inpsections_setup.*.agency.in' => __('Choose a valid agency'),
        ];
    }

    public function prepareForValidation()
    {
        $this->job_id = $this->route('job')->id ?? 0;
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'is_active' => $this->get('active'),
        ]);
    }
}
