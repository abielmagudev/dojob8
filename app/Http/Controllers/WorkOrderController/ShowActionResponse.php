<?php

namespace App\Http\Controllers\WorkOrderController;

use App\Http\Controllers\WorkOrderController\ShowActionResponses\Kernel\ShowActionResponseBase;
use App\Http\Controllers\WorkOrderController\ShowActionResponses\Kernel\ShowActionResponseInterface;
use App\Models\WorkOrder;

class ShowActionResponse
{
    const DEFAULT_TAB = 'summary';

    public $class_generated;

    public function __construct(string $tab = null)
    {
        $this->class_generated = $this->generate( $tab ?? self::DEFAULT_TAB );
    }

    public function generate(string $tab)
    {
        return __NAMESPACE__ . '\\ShowActionResponses\\' . ucfirst( strtolower($tab) );
    }

    public function validate()
    {
        return class_exists( $this->class_generated ) 
                // && is_a($this->class_generated, ShowActionResponseBase::class)
                && in_array(ShowActionResponseInterface::class, class_implements($this->class_generated));
    }

    public function factory(WorkOrder $work_order)
    {
        $classname = $this->class_generated;

        return new $classname($work_order);
    }
}
