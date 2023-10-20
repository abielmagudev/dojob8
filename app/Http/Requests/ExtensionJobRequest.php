<?php

namespace App\Http\Requests;

use App\Models\Extension;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExtensionJobRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'extension' => [
                'required',
                sprintf('exists:%s,id', Extension::class),
                Rule::unique('extension_job', 'extension_id')->where('job_id', $this->route('job')->id),
            ],
        ];

        if(! $this->isMethod('POST') )
            unset( $rules['extension'][2] ); // Rule::unique

        return $rules;
    }

    public function withValidator($validator)
    {
        if( $validator->fails() )
            session()->flash('danger', $validator->errors()->first());
    }
}
