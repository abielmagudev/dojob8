<?php

namespace App\Http\Requests\WorkOrderUpdateRequest\WorkOrderUpdaters;

use App\Http\Requests\WorkOrderUpdateRequest\WorkOrderUpdaters\Kernel\Updater;

class CrewMemberUser extends Updater
{
    public function prepareForValidation()
    {
        if( $this->request->get('status') == 'working' )
        {
            $this->request->merge([
                'working_at' => now()->format('Y-m-d H:i'),
            ]);
        }

        if( $this->request->get('status') == 'done' )
        {
            $this->request->merge([
                'done_at' => now()->format('Y-m-d H:i'),
            ]);
        }
    }

    public function rules()
    {
        return [
            'working_at' => [
                'required_if:status,working',
            ],
            'done_at' => [
                'required_if:status,done',
            ],
            'notes' => [
                'nullable',
            ],
            'status' => [
                'required',
                'string',
                'in:working,done',
            ],
        ];
    }
}
