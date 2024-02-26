<?php

namespace App\BladeX;

use Illuminate\Support\Facades\Blade;

class CanAny
{
    public static function boot()
    {
        Blade::directive('canAny', function ($permissions) {
            return "<?php if( auth()->check() && auth()->user()->canAny({$permissions}) || empty({$permissions}) ): ?>";
        });

        Blade::directive('endcanAny', function () {
            return '<?php endif; ?>';
        });
    }
}
