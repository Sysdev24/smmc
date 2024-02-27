<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Passport implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return is_string($value) && preg_match('/^[a-zA-Z0-9]+$/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'No debe incluir caracteres especiales.';
    }
}
