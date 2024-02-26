<?php

namespace App\Http\Requests;

use App\Models\Crew;
use App\Models\Member;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class CrewMemberUpdateRequest extends FormRequest
{
    public $id_crew_members = '';

    public function authorize()
    {
        return auth()->user()->can('edit-crew-members');
    }

    protected function failedAuthorization()
    {
        if( isAjaxRequest($this) ) {
            return response()->json(['error' => 'This action is unauthorized.'], 403);
        }
        
        throw new AuthorizationException('This action is unauthorized.');
    }

    public function rules()
    {
        return [
            'crew' => [
                'bail',
                'required',
                'integer',
                sprintf('exists:%s,id,is_active,1', Crew::class),
            ],
            'members' => [
                'nullable',
                'array',
            ],
            'members.*' => [
                sprintf('in:%s', $this->id_crew_members),
            ],
        ];
    }

    public function messages()
    {
        return [
            'crew.integer' => __('Choose a valid crew'),
            'crew.exists' => __('Choose a valid and active crew'),
            'members.array' => __('Choose one or more members from the list'),
            'members.*.in' => __('Choose a valid member from the list'),
        ];
    }

    public function prepareForValidation()
    {
        if(! is_array($this->get('members')) ) {
            return;
        }

        $this->id_crew_members = Member::available()
        ->whereIn('id', $this->get('members'))
        ->get()
        ->pluck('id')
        ->implode(',');
    }

    public function failedValidation(Validator $validator)
    {
        if( isAjaxRequest($this) )
        {
            $response = new JsonResponse(['errors' => $validator->errors()], 422);
            throw new HttpResponseException($response); 
        }

        session()->flash('danger', $validator->errors()->first());
    }
}
