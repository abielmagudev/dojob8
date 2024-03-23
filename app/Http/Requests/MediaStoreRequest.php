<?php

namespace App\Http\Requests;

use App\Models\Media\Kernel\MediaRestriction;
use Illuminate\Foundation\Http\FormRequest;

class MediaStoreRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('create-media');
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
                sprintf('max:%s', MediaRestriction::maxsize()),
                sprintf('mimes:%s', MediaRestriction::mimes()->implode(',')),
            ],
        ];
    }

    public function messages()
    {
        return [
            'media.*.file' => __('Choose from the form file field'),
            'media.*.max' => __('The maximum size of each photo or file is 5 MB'),
            'media.*.mimes' =>  __('Choose only with these formats: ' . MediaRestriction::mimes()->implode(', ')),
            'media.array' => __('Choose one or more photos and files from your device'),
            'media.required' => __('Choose one or more photos and files'),
        ];
    }

    public function withValidator($validator)
    {
        if( $validator->fails() ) {
            $this->session()->flash('warning', $validator->errors()->first());
        }
    }
}
