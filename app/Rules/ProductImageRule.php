<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class ProductImageRule implements ValidationRule
{
    private const VALID_TYPES = [
        IMAGETYPE_PNG,
        IMAGETYPE_JPEG,
        IMAGETYPE_WEBP,
    ];
    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        list($width, $height, $type) = getimagesize($value);

        if ($width < 100 || $width > 1000 || $height < 100 || $height > 1000) {
            $fail('The :attribute has invalid dimensions.');
        }

        if (!in_array($type, self::VALID_TYPES, true)) {
            $fail('The :attribute has invalid type. Allowed types: jpeg, png, webp');
        }
    }
}
