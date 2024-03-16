<?php

namespace App\Http\Controllers\WorkOrderController\Show;

class TabDataLoader
{
    const DEFAULT = 'information';

    public static function get(string $tab = null)
    {
        if( is_null($tab) ) {
            return  app(ShowDataLoadersContainer::get(self::DEFAULT));
        }

        return app(ShowDataLoadersContainer::get($tab));
    }
}
