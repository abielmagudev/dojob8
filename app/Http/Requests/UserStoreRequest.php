<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Models\User\UserProfiler;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    public $profile;

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
                'min:6',
                sprintf('regex:%s', User::NAME_PATTERN),
                sprintf('unique:%s,name', User::class),
            ],
            'email' => [
                'bail',
                'required',
                'email',
                sprintf('unique:%s,email', User::class),
            ],
            'password' => [
                'required',
                'min:8',
            ],
            'confirm_password' => [
                'required_with:password',
                'same:password',
            ],
        ];
    }

    public function prepareForValidation()
    {
        if(! $this->profile = UserProfiler::find($this->id, $this->profile) ) {
            abort(404);
        }
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'profile_type' => get_class($this->profile),
            'profile_id' => $this->profile->id,
            'is_active' => $this->get('active'),
        ]);
    }
}
