<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class SesiRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $validationOptions;
    public $dateToCompare;

    public function __construct($validationOptions, $date)
    {
        $this->validationOptions = $validationOptions;
        $this->dateToCompare = $date;
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
        $time = Carbon::parse($value);
        $endTime = Carbon::parse($this->dateToCompare);

        return $this->validationOptions == 'past' ? $time->format('h:i') && $time < $endTime :
            $time->format('h:i') && $time > $endTime;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Waktu tidak valid';
    }
}
