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
            'lastname' => [
                'required',
                'string',
            ],
            'fullname' => [
                'bail',
                'required',
                'string',
                sprintf('unique:%s,fullname,%s', Member::class, $this->member_id),
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
            'category' => [
                'required',
                sprintf('in:%s', implode(',', Member::getCategories())),
            ],
            'scope' => [
                'required',
                sprintf('in:%s', implode(',', Member::getScopes())),
            ],
            'is_active' => [
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
            'fullname' => sprintf('%s %s', $this->name, $this->lastname),
        ]);
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'name' => Str::title($this->name),
            'lastname' => Str::title($this->lastname),
            'fullname' => Str::title($this->fullname),
            'is_active' => $this->isMethod('POST') || $this->has('is_active') ? 1 : 0,
        ]);
    }
}