<?php


namespace Abdelrahmanrafaat\SchemaToCode\Helpers;

/**
 * Class IntegersHelpers
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Helpers
 */
class IntegersHelpers
{
    /**
     * @param int $number
     *
     * @return bool
     */
    public static function isEven(int $number): bool
    {
        return ($number % 2) == 0;
    }
}