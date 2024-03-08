<?php

namespace App\Http\Controllers\UserController\Requests;

use App\Models\User\Kernel\ProfileContainer;
use Illuminate\Http\Request;

class ProfileQueryStringMapper
{
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function profileShort()
    {
        $keys = $this->request->keys();

        return reset($keys);
    }

    public function profileId()
    {
        return $this->request->get( $this->profileShort() );
    }

    public function profileType()
    {
        return ProfileContainer::getType( $this->profileShort() );
    }


    // Statics

    public static function validate(Request $request)
    {
        return ProfileContainer::shorts()->filter(function ($short) use ($request) {
            return $request->filled($short);
        })->isNotEmpty();
    }

    public static function make(Request $request)
    {
        if(! self::validate($request) ) {
            return;
        }

        return new self($request);
    }
}
