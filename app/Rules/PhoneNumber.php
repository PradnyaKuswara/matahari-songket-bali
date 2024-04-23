<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PhoneNumber implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! preg_match('/'.config('validation.phone_number.regex').'/', $value)) {
            $fail("The $attribute field is not a valid phone number.");
        }

        if (preg_match('/[-\s\+]/', $value)) {
            $fail("The $attribute field should not contain hyphens, spaces, or plus signs.");
        }

        if (strlen($value) < 10) {
            $fail("The $attribute field should has min 10 digits");
        }

        if (strlen($value) > config('validation.phone_number.maxlength')) {
            $fail("The $attribute field should has max 15 digits");
        }
    }
}
