<?php

namespace App\Http\Requests;

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
            'successful_inspections' => [
                'required',
                'integer',
                'min:0',
            ],
            'extensions' => [
                'nullable',
                'array',
            ],
            'extensions.*' => [
                'integer',
            ],
        ];
    }

    public function messages()
    {
        return [
            'extensions.*.integer' => __('Choose a valid extension'),
        ];
    }

    public function prepareForValidation()
    {
        $this->job_id = $this->route('job')->id ?? 0;
    }
}
