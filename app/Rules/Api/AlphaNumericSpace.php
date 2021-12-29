<?php

namespace App\Rules\Api;

use Illuminate\Contracts\Validation\Rule;

class AlphaNumericSpace implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return (preg_match("/^[0-9A-z ]+$/i", $value)) ? true : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Only letters, numbers and spaces allowed';
    }
}
