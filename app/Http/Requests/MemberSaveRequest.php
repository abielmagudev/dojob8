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
            'can_be_in_crews' => [
                'nullable',
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
            'full_name' => sprintf('%s %s', $this->name, $this->last_name),
        ]);
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'name' => Str::title($this->name),
            'last_name' => Str::title($this->last_name),
            'full_name' => Str::title($this->full_name),
            'is_active' => $this->isMethod('POST') || $this->has('is_active') ? 1 : 0,
            'can_be_in_crews' => $this->isMethod('POST') || $this->get('can_be_in_crews') == 1 ? 1 : 0,
        ]);
    }
}
