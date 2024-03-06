<?php

namespace App\Http\Requests;

use App\Models\Media;
use App\Models\Media\Kernel\MediaModelContainer;
use Illuminate\Foundation\Http\FormRequest;

class MediaDestroyRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('delete-media');
    }

    public function prepareForValidation()
    {
        abort_if(! MediaModelContainer::has( $this->model_key ), 404);
    }

    public function rules()
    {
        return [
            'media' => [
                'required',
                'array',
            ],
            'media.*' => [
                'required',
                sprintf('exists:%s,id', Media::class)
            ],
            'model_key' => [
                'required',
            ],
            'model_id' => [
                'required',
                sprintf('exists:%s,id', MediaModelContainer::get($this->model_key))
            ],
        ];
    }

    public function messages()
    {
        return [
            'media.required' => __('Choose one or more photos and files'),
            'media.array' => __('Choose one or more photos and files from the list'),
            'media.*.required' => __('Check one or more photos and files'),
            'media.*.exists' => __('Check one or more existing photos and files'),
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
