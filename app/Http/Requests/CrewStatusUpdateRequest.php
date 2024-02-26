<?php

namespace App\Http\Requests;

use App\Models\Crew;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CrewStatusUpdateRequest extends FormRequest
{
    public $id_active_crews = '';

    public function authorize()
    {
        return auth()->user()->can('edit-crews');
    }

    public function rules()
    {
        return [
            'crews' => [
                'nullable',
                'array',
            ],
            'crews.*' => [
                sprintf('in:%s', $this->id_active_crews),
            ],
        ];
    }

    public function prepareForValidation()
    {
        if( is_array($this->get('crews')) ) {
            $this->id_active_crews = Crew::whereIn('id', $this->get('crews'))->get()->pluck('id')->implode(',');
        }
    }

    public function failedValidation(Validator $validator)
    {
        session()->flash('danger', $validator->errors()->first());
    }
}
