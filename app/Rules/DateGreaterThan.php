<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DateGreaterThan implements Rule
{    private $compareDate;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($compareDate)
    {
        $this->compareDate = $compareDate;
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
        return strtotime($value) < strtotime($this->compareDate);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'La Fecha Proporcionada es mayor a la Fecha Limite';
    }
}
