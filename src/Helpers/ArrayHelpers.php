<?php

namespace Abdelrahmanrafaat\SchemaToCode\Helpers;

/**
 * Class ArrayHelpers
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Helpers
 */
class ArrayHelpers
{
    /**
     * @param array $lines
     *
     * @return array
     */
    public static function filterEmptyLines(array $lines): array
    {
        return array_filter($lines, function ($line) {
            return !StringHelpers::isEmpty($line);
        });
    }

    /**
     * @param array $pieces
     *
     * @return string
     */
    public static function colonImplode(array $pieces): string
    {
        return implode(':', $pieces);
    }

    /**
     * @param array $pieces
     *
     * @return string
     */
    public static function commaImplode(array $pieces): string
    {
        return implode(',', $pieces);
    }

    /**
     * @param array $array
     *
     * @return array
     */
    public static function reverse(array $array): array
    {
        return array_reverse($array);
    }

    /**
     * @param       $needle
     * @param array $haystack
     *
     * @return int
     */
    public static function search($needle, array $haystack): int
    {
        $index = array_search($needle, $haystack);

        return ($index === false) ? -1 : $index;
    }

    /**
     * @param array $array
     *
     * @return array
     */
    public static function unique(array $array): array
    {
        return array_unique($array);
    }

}
