<?php

namespace App\Enums;

abstract class BaseEnum
{
    /**
     * Get All Filed
     * @return array
     */
    public static function All(): array
    {
        $reflection = new \ReflectionClass(static::class);
        return $reflection->getConstants();
    }

    /**
     * Get All Filed
     * @return array
     */
    public static function Except($items): array
    {
        $reflection = new \ReflectionClass(static::class);
        $variables = $reflection->getConstants();

        foreach ($variables as $key => $variable) {
            if (is_array($items)) {
                if (in_array($variable, $items)) {
                    unset($variables[$key]);
                }
            } else {
                if ($variable === $items) {
                    unset($variables[$key]);
                }
            }
        }

        return $variables;
    }


    /**
     * Get All Filed
     * @return array
     */
    public static function AllValue(): array
    {
        $reflection = new \ReflectionClass(static::class);
        $values = [];
        foreach ($reflection->getConstants() as $item) {
            $values[] = $item;
        }
        return $values;
    }

    /**
     * Get Title a Field
     * @param string $key
     * @return string
     */
    public static function trans($key = null, $default = '-')
    {
        if (is_null($key)) return '';
        $namespace = explode('\\', static::class);
        $address = 'admin/enums/' . end($namespace) . ".$key";
        return trans($address) != $address ? trans($address) : $default;
    }

    public static function asString()
    {
        $reflection = new \ReflectionClass(static::class);
        return implode(",", array_keys($reflection->getConstants()));
    }

    public static function asStringValues()
    {
        $reflection = new \ReflectionClass(static::class);
        return implode(",", $reflection->getConstants());
    }

    public static function getDescription($value)
    {
        $reflection = new \ReflectionClass(static::class);
        $array = $reflection->getConstants();
        return $array[$value] ?? '';
    }

    public static function getTranslatedAll()
    {
        $reflection = new \ReflectionClass(static::class);
        $values = [];
        foreach ($reflection->getConstants() as $item) {
            $values[$item] = self::trans($item);
        }
        return $values;
    }

    /**
     * Get All Filed
     * @return array
     */
    public static function getKeyByValue($value): string
    {
        $reflection = new \ReflectionClass(static::class);
        $flipConstants = array_flip($reflection->getConstants());
        return $flipConstants[$value] ?? "";
    }
}
