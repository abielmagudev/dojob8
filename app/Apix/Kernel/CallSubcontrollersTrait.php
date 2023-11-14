<?php 

namespace App\Apix\Kernel;

use App\Http\Controllers\Kernel\ControllerFormRequestResolver;

trait CallSubcontrollersTrait
{
    public function callSubcontroller(string $sub, string $method, array $parameters = [])
    {
        $this->validateSubcontroller($sub);

        $subcontroller = $this->getSubcontroller($sub);

        $requests = ControllerFormRequestResolver::make($subcontroller, $method);

        return app($subcontroller)->callAction($method, [...$requests, ...$parameters]);
    }

    public function getSubcontroller(string $sub)
    {        
        return $this->existsSubalias($sub) ? self::$subaliases_subcontrollers[$sub] : $sub;
    }

    public function validateSubcontroller(string $sub)
    {
        if(! $this->existsSubalias($sub) &&! $this->existsSubcontroller($sub) ) {
            return abort(404);
        }
    }

    public function existsSubalias(string $sub)
    {
        return property_exists(self::class, 'subaliases_subcontrollers') && array_key_exists($sub, self::$subaliases_subcontrollers);
    }

    public function existsSubcontroller(string $sub)
    {
        return class_exists($sub);
    }
    
    // ------------------------------------------------------------------------

    public static function getSubaliases()
    {
        return array_keys(self::$subaliases_subcontrollers);
    }

    public static function getSubcontrollers()
    {
        return array_values(self::$subaliases_subcontrollers);
    }
}
