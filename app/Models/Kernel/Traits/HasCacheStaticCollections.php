<?php

namespace App\Models\Kernel\Traits;

trait HasCacheStaticCollections
{
    protected static $static_collection_cache = [];

    protected static function collectionCache(string $key, array $values)
    {
        if(! isset(self::$static_collection_cache[$key]) ) {
            self::$static_collection_cache[$key] = collect($values);
        }

        return self::$static_collection_cache[$key];
    }
}
