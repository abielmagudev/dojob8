<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CategoryRestrictedName implements Rule
{
    public function passes($attribute, $value)
    {
        $lowercase = trim( strtolower($value) );

        return ! in_array($lowercase, ['all categories', 'uncategorized']);
    }

    public function message()
    {
        return 'Write another name for the category.';
    }
}
