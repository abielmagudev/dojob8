<?php

namespace App\Http\Requests;

use App\Models\Agency;
use Illuminate\Foundation\Http\FormRequest;

class AgencySaveRequest extends FormRequest
{
    public $agency_id;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'bail',
                'required',
                'string',
                sprintf('unique:%s,name,%s', Agency::class, $this->agency_id),
            ],
            'notes' => [
                'nullable',
                'string',
            ],
        ];
    }

    public function prepareForValidation()
    {
        $this->agency_id = $this->route('agency')->id ?? 0;
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'is_active' => $this->get('active'),
        ]);
    }
}
