<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EmptyCashCashier implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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

          // Verifica si el usuario tiene un role_id igual a 8 que es el cajero
          if ($value['rol_id'] == 8) {
            // Verifica si el usuario proporcionó un caja_id
            if (empty($value['cash_id'])) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
