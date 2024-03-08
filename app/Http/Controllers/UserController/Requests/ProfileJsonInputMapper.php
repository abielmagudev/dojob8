<?php

namespace App\Http\Controllers\UserController\Requests;

use App\Models\User\Kernel\ProfileContainer;
use Illuminate\Http\Request;

class ProfileJsonInputMapper
{
    protected $profile_input_cache;

    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function profileInput()
    {
        if( is_null($this->profile_input_cache) ) {
            $this->profile_input_cache = json_decode( $this->request->input('profile'), true );
        }

        return $this->profile_input_cache;
    }

    public function profileShort()
    {
        return key( $this->profileInput() );
    }

    public function profileId()
    {
        return $this->profileInput()[ $this->profileShort() ] ?? null;
    }

    public function profileType()
    {
        return ProfileContainer::getType( $this->profileShort() );
    }


    // Statics

    public static function validate(Request $request)
    {
        return isJson( $request->input('profile') );
    }

    public static function make(Request $request)
    {
        if(! self::validate($request) ) {
            return;
        }

        return new self($request);
    }
}
