<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class BobotRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $bobot;

    public function __construct($bobot = 0)
    {
        $this->bobot = $bobot;
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
        return $this->bobot + $value === 100;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Persentase bobot tidak valid.';
    }
}
