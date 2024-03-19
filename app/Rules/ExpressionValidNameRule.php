<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ExpressionValidNameRule implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match('/^[A-Za-z\s]+$/', $value);
    }

    public function message()
    {
        return 'Write valid text with letters and spaces.';
    }
}
