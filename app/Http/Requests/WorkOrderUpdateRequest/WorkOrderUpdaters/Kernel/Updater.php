<?php

namespace App\Http\Requests\WorkOrderUpdateRequest\WorkOrderUpdaters\Kernel;

use Illuminate\Http\Request;

class Updater
{
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function prepareForValidation()
    {
        return;
    }

    public function rules()
    {
        return [];
    }

    public function messages()
    {
        return [];
    }

    public function validated()
    {
        return [];
    }
}
