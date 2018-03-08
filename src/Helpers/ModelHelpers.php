<?php

namespace Abdelrahmanrafaat\SchemaToCode\Helpers;

use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\ModelsCreator;

class ModelHelpers
{
    /**
     * @param array $strings
     *
     * @return array
     */
    public static function normalizedModelsMap(array $strings): array
    {
        return ArrayHelpers::unique(
            array_map(function ($string) {
                return self::normalizeModel($string);
            }, $strings)
        );
    }

    /**
     * @param string $modelName
     *
     * @return string
     */
    public static function normalizeModel(string $modelName): string
    {
        return StringHelpers::upperCaseFirst(
            StringHelpers::singular(
                StringHelpers::camelCase(trim($modelName))
            )
        );
    }

    /**
     * @param array $strings
     *
     * @return array
     */
    public static function normalizedRelationSymbolsMap(array $strings): array
    {
        return array_map(function ($string) {
            return self::normalizeRelationSymbol($string);
        }, $strings);
    }

    /**
     * @param string $relationSymbol
     *
     * @return string
     */
    public static function normalizeRelationSymbol(string $relationSymbol): string
    {
        return StringHelpers::lowerCase(trim($relationSymbol));
    }

    /**
     * @param string $modelName
     *
     * @return string
     */
    public static function modelNameToTableName(string $modelName): string
    {
        return StringHelpers::plural(StringHelpers::snakeCase($modelName));
    }

    /**
     * @param string $modelName
     *
     * @return string
     */
    public static function modelNameToForeignKey(string $modelName): string
    {
        return StringHelpers::snakeCase($modelName) . '_id';
    }

    /**
     * @param string $modelName
     * @param bool   $pluralize
     *
     * @return string
     */
    public static function modelNameToMethodName(string $modelName, bool $pluralize = false): string
    {
        $methodName = StringHelpers::lowerCaseFirst($modelName);

        return ($pluralize) ? StringHelpers::plural($methodName) : $methodName;
    }

    /**
     * @return string
     */
    public static function createModelStubPath(): string
    {
        return ModelsCreator::stubsDirectoryPath() . DIRECTORY_SEPARATOR . 'create_model.stub';
    }

    /**
     * @param string $modelName
     *
     * @return string
     */
    public static function getModelPath(string $modelName): string
    {
        return app_path($modelName . '.php');
    }

}