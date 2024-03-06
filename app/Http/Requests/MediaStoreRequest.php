<?php

namespace App\Http\Requests;

use App\Models\Media\Kernel\MediaModelContainer;
use App\Models\Media\Kernel\FileRestriction;
use Illuminate\Foundation\Http\FormRequest;

class MediaStoreRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('create-files');
    }

    public function prepareForValidation()
    {
        abort_if(! MediaModelContainer::has( $this->get('model_key') ), 404);
    }

    public function rules()
    {
        return [
            'media' => [
                'required',
                'array',
            ],
            'media.*' => [
                'file',
                sprintf('max:%s', FileRestriction::maxsize()),
                sprintf('mimes:%s', FileRestriction::mimes()->implode(',')),
            ],
            'model_key' => [
                'required',
            ],
            'model_id' => [
                sprintf('exists:%s,id', MediaModelContainer::get($this->model_key))
            ],
        ];
    }

    public function messages()
    {
        return [
            'media.*.file' => __('Choose from the form file field'),
            'media.*.max' => __('The maximum size of each photo or file is 5 MB'),
            'media.*.mimes' =>  __('Choose only with these formats: ' . FileRestriction::mimes()->implode(', ')),
            'media.array' => __('Choose one or more photos and files from your device'),
            'media.required' => __('Choose one or more photos and files'),
            'model_id.*' => __('Upload method does not exist'),
            // 'model_key.*' => __('Invalid upload method'),
        ];
    }

    public function withValidator($validator)
    {
        if( $validator->fails() ) {
            $this->session()->flash('warning', $validator->errors()->first());
        }
    }
}
