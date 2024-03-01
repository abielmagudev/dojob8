<?php

namespace App\Http\Requests\WorkOrderRequest\Update;

use App\Http\Requests\WorkOrderRequest\Update\Updaters\AdminUser;
use App\Http\Requests\WorkOrderRequest\Update\Updaters\WorkerUser;
use Illuminate\Http\Request;

class Loader
{
    public $updaters = [
        'admin' => AdminUser::class,
        'worker' => WorkerUser::class,
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
