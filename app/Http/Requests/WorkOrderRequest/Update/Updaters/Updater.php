<?php

namespace App\Http\Requests\WorkOrderRequest\Update\Updaters;

use Illuminate\Http\Request;

class Updater
{
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
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
