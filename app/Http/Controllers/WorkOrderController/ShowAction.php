<?php

namespace App\Http\Controllers\WorkOrderController;

use App\Http\Controllers\WorkOrderController\ShowResponses\Kernel\ShowResponseBase;
use App\Models\WorkOrder;

class ShowAction
{
    const DEFAULT_RESPONSE = 'summary';

    public $classname;

    public function __construct(string $response)
    {
        $this->classname = $this->generate( $response );

        if(! $this->exists() ) {
            $this->classname = $this->generate( self::DEFAULT_RESPONSE );
        }
    }

    public function generate(string $response)
    {
        return __NAMESPACE__ . '\\ShowResponses\\' . ucfirst( strtolower($response) );
    }

    public function exists()
    {
        return class_exists( $this->classname ) && is_subclass_of($this->classname, ShowResponseBase::class);
    }

    public function factory(WorkOrder $work_order)
    {
        $classname = $this->classname;
        return new $classname($work_order);
    }
}
