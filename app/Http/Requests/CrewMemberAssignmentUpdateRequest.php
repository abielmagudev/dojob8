<?php

namespace App\Http\Requests;

use App\Http\Controllers\CrewMemberAssignmentController\ScheduledFetcherContainer;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CrewMemberAssignmentUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->canAny(['edit-work-orders', 'edit-inspections']);
    }

    public function rules()
    {
        return [
            'template' => [
                'required',
                'in:grid,list'
            ],
            'assignment' => [
                'required',
                sprintf('in:%s', ScheduledFetcherContainer::keys()->implode(',')),
            ],
            'scheduled_date' => [
                'required',
                'date',
                sprintf('after_or_equal:%s', now()->format('Y-m-d'))
            ],
            'keep_crew_members_saved' => [
                'nullable',
                'boolean',
            ],
        ];
    }

    public function withValidator(Validator $validator)
    {
        if( $validator->fails() ) {
            session()->flash('danger', $validator->errors()->first());
        }
    }
}
