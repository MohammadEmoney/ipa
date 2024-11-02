<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EmailsValidation implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $emails = explode(',', $value);

        foreach ($emails as $email) {
            if (!filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {
                $fail(__('validation.custom.emails.valid', ['attribute' => $attribute]));
            }
        }
    }
}
