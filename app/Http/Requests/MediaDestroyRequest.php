<?php

namespace App\Http\Requests;

use App\Models\Media;
use Illuminate\Foundation\Http\FormRequest;

class MediaDestroyRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('delete-media');
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
        ];
    }

    public function messages()
    {
        return [
            'media.required' => __('Choose one or more photos and files'),
            'media.array' => __('Choose one or more photos and files from the list'),
            'media.*.required' => __('Check one or more photos and files'),
            'media.*.exists' => __('Check one or more existing photos and files'),
        ];
    }

    public function withValidator($validator)
    {
        if( $validator->fails() ) {
            $this->session()->flash('warning', $validator->errors()->first());
        }
    }
}
