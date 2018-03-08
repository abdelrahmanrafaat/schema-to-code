<?php

namespace Abdelrahmanrafaat\SchemaToCode\Helpers;

use \Illuminate\Filesystem\Filesystem;

/**
 * Class StringHelpers
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Helpers
 */
class StringHelpers
{
    /**
     * @param string $string
     *
     * @return string
     */
    public static function trimSlashes(string $string): string
    {
        return trim($string, '/');
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public static function plural(string $string): string
    {
        return str_plural($string);
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public static function singular(string $string): string
    {
        return str_singular($string);
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public static function upperCaseFirst(string $string): string
    {
        return ucfirst($string);
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public static function lowerCaseFirst(string $string):string
    {
        return lcfirst($string);
    }

    /**
     * @param string $string
     *
     * @return bool
     */
    public static function isEmpty(string $string): bool
    {
        return empty(trim($string));
    }

    /**
     * @param string $string
     *
     * @return array
     */
    public static function toLinesArray(string $string): array
    {
        return explode(PHP_EOL, $string);
    }

    /**
     * @param string $string
     *
     * @return array
     */
    public static function colonExplode(string $string): array
    {
        return explode(':', $string);
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public static function lowerCase(string $string): string
    {
        return strtolower($string);
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public static function camelCase(string $string): string
    {
        return camel_case($string);
    }

    /**
     * @param string $subject
     * @param string $oldValue
     * @param string $newValue
     *
     * @return string
     */
    public static function replace(string $subject, string $oldValue, string $newValue): string
    {
        return str_replace($oldValue, $newValue, $subject);
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public static function snakeCase(string $string):string
    {
        return snake_case($string);
    }

    /**
     * @param \Illuminate\Filesystem\Filesystem $filesystem
     * @param string                            $stubPath
     * @param array                             $templates
     *
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public static function populateStub(Filesystem $filesystem, string $stubPath, array $templates): string
    {
        $stub = $filesystem->get($stubPath);
        foreach ($templates as $template => $value)
            $stub = StringHelpers::replace($stub, $template, $value);

        return $stub;
    }
}
