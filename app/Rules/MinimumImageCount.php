<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MinimumImageCount implements Rule
{

    private $minimumCount;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($minimumCount)
    {
        $this->minimumCount = $minimumCount;
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
        $imageCount = count($value);
        return $imageCount >= $this->minimumCount;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please upload at least {$this->$minimumCount} product images ';
    }
}
