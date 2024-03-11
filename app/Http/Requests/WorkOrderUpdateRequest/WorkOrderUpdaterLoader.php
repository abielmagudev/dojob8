<?php

namespace App\Http\Requests\WorkOrderUpdateRequest;

use App\Http\Requests\WorkOrderUpdateRequest\WorkOrderUpdaters\AdminUser;
use App\Http\Requests\WorkOrderUpdateRequest\WorkOrderUpdaters\CrewMemberUser;
use Illuminate\Http\Request;

class WorkOrderUpdaterLoader
{
    public $updaters = [
        'admin' => AdminUser::class,
        'crew member' => CrewMemberUser::class,
    ];

    public $loaded;

    public function __construct(Request $request)
    {
        $this->loaded = $this->load($request);
    }

    public function __call($name, $arguments)
    {
        return call_user_func([$this->loaded, $name], $arguments);
    }

    public function load(Request $request)
    {
        $role = auth()->user()->role_name;
        
        $updater = array_key_exists($role, $this->updaters) ? $this->updaters[$role] : $this->updaters['admin'];
        
        return new $updater($request);
    }
}
