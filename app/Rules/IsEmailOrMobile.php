<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class IsEmailOrMobile implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Check 1: Is it a valid email address?
        $isEmail = filter_var($value, FILTER_VALIDATE_EMAIL) !== false;

        // Check 2: Does it match the mobile format (starts with 09, total 11 digits)?
        $isMobile = preg_match('/^09\d{9}$/', $value) === 1;

        // If it's neither an email nor a valid mobile number, fail the validation.
        if (!$isEmail && !$isMobile) {
            $fail(__('main.invalid-identifier'));
        }
    }
}
