<?php
/**
 * Created by PhpStorm.
 * User: faridcs
 * Date: 6/10/18
 * Time: 6:50 PM
 */

namespace App\Enums;

use ReflectionClass;

abstract class Enum
{
    /**
     * Get list of available items
     *
     * @return array
     * @throws \ReflectionException
     */
    public static function get(): array
    {
        $reflection = new ReflectionClass(static::class);
        return $reflection->getConstants();
    }

    /**
     * Return a random item in Enum
     *
     * @return int
     * @throws \ReflectionException
     */
    public static function random(): int
    {
        $reflection = new ReflectionClass(static::class);
        $options = array_flip($reflection->getConstants());

        return array_rand($options);
    }

    /**
     * Get the item title
     *
     * @param $index
     * @return string|null
     * @throws \ReflectionException
     */
    public static function title($index)
    {
        $reflection = new ReflectionClass(static::class);
        $list = array_flip($reflection->getConstants());

        return $list[$index] ?? null;
    }
}