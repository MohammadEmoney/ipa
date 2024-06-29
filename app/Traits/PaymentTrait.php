<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait PaymentTrait
{
    /**
     * Char Length
     *
     * @param string $charLength
     * @return string
     */
    public function generateUniqueCode(string $model, string $field, int $charLength = 6, $prefix = 'IPA'): string
    {
        $generatedCode = $prefix . '-' . Str::random($charLength) . time();
        if($model::where($field, "$generatedCode")->exists())
            $this->generateUniqueCode($model, $field, $charLength);
        return $generatedCode;
    }
}
