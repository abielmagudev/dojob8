<?php

namespace App\Http\Requests;

use App\Models\Member;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class MemberSaveRequest extends FormRequest
{
    public $member_id;

    public function authorize()
    {
        return true;
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
                sprintf('unique:%s,full_name,%s', Member::class, $this->member_id),
            ],
            'birthdate' => [
                'nullable',
                'date',
            ],
            'phone_number' => [
                'nullable',
                'string',
            ],
            'mobile_number' => [
                'nullable',
                'string',
            ],
            'email' => [
                'nullable',
                'email',
            ],
            'position' => [
                'nullable',
                'string',
            ],
            'is_active' => [
                'nullable',
                'boolean',
            ],
            'is_crew_member' => [
                'required',
                'boolean',
            ],
            'notes' => [
                'nullable',
                'string',
            ],
        ];
    }

    public function prepareForValidation()
    {
        $this->member_id = $this->route('member')->id ?? 0;

        $this->merge([
            'name' => Str::title($this->name),
            'last_name' => Str::title($this->last_name),
            'full_name' => Str::title( sprintf('%s %s', $this->name, $this->last_name) ),
        ]);
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'is_active' => $this->isMethod('POST') || $this->has('is_active') ? 1 : 0,
            'is_crew_member' => (int) $this->is_crew_member,
        ]);
    }
}
