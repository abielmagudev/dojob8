<?php

namespace App\Http\Requests;

use App\Models\Member;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class MemberStoreRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->canAny('create-members');
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
            ],
            'last_name' => [
                'required',
                'string',
            ],
            'full_name' => [
                'bail',
                'required',
                'string',
                sprintf('unique:%s,full_name', Member::class),
            ],
            'birthdate' => [
                'nullable',
                'date',
            ],
            'email' => [
                'nullable',
                'email',
            ],
            'mobile_number' => [
                'nullable',
                'string',
            ],
            'phone_number' => [
                'nullable',
                'string',
            ],
            'position' => [
                'nullable',
                'string',
            ],
            'is_crew_member' => [
                'required',
                'boolean',
            ],
            'notes' => [
                'nullable',
                'string',
            ],
            'is_available' => [
                'sometimes',
                'boolean',
            ],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'full_name' => sprintf('%s %s', $this->name, $this->lastname),
        ]);
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'name' => $this->name,
            'last_name' => $this->last_name,
            'full_name' =>  $this->full_name,
            'is_crew_member' => (int) $this->filled('is_crew_member'),
            'is_available' => (int) $this->filled('is_available'),
        ]);
    }
}
