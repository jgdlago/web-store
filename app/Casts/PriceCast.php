<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class PriceCast implements CastsAttributes
{
    /**
     * @param Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return string|null
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): ?string
    {
        if ($value === null) {
            return null;
        }

        if (!is_numeric($value)) {
            return null;
        }

        return number_format($value / 100, 2, ',', '.');
    }

    /**
     * @param Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return int|null
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): ?int
    {
        if ($value === null) {
            return null;
        }

        if (is_string($value)) {
            $value = str_replace(',', '.', $value);
            $value = floatval($value);
        }

        if (!is_numeric($value)) {
            throw new \InvalidArgumentException("O valor deve ser numérico para ser convertido em centavos.");
        }

        $value *= 100;

        return (int) $value;
    }
}



