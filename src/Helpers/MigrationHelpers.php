<?php

namespace Abdelrahmanrafaat\SchemaToCode\Helpers;

use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Constants;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\MigrationsCreator;
use DateTime;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

/**
 * Class MigrationHelpers
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Helpers
 */
class MigrationHelpers
{
    /**
     * @param string $migrationName
     *
     * @return string
     */
    public static function getClassName(string $migrationName): string
    {
        return Str::studly($migrationName);
    }

    /**
     * @param string $migrationName
     *
     * @return string
     */
    public static function getMigrationPath(string $migrationName): string
    {
        $migrationsPath = app()->databasePath() . DIRECTORY_SEPARATOR . 'migrations';

        return $migrationsPath . DIRECTORY_SEPARATOR . self::getDatePrefix() . '_' . $migrationName . '.php';
    }

    /**
     * @return string
     */
    public static function getDatePrefix(): string
    {
        return DateTime::createFromFormat('U.u', microtime(true))->format("Y_m_d_H:i:s.u");
    }

    /**
     * @param string $model
     *
     * @return string
     */
    public static function createTableMigrationName(string $model): string
    {
        return 'create_' . ModelHelpers::modelNameToTableName($model) . '_table';
    }

    /**
     * @param string $model
     *
     * @return string
     */
    public static function updateRelationsMigrationName(string $model): string
    {
        return 'update_' . ModelHelpers::modelNameToTableName($model) . '_relations';
    }

    public static function manyToManyTableName(string $model, string $relatedModel): string
    {
        $sortedModels = array_sort([$model, $relatedModel]);

        return ModelHelpers::modelNameToTableName($sortedModels[0]) . '_' . ModelHelpers::modelNameToTableName($sortedModels[1]);
    }

    /**
     * @param string $model
     * @param string $relatedModel
     *
     * @return string
     */
    public static function manyToManyMigrationName(string $model, string $relatedModel): string
    {
        return 'create_' . self::manyToManyTableName($model, $relatedModel) . '_table';
    }

    /**
     * @return string
     */
    public static function createTableStubPath(): string
    {
        return MigrationsCreator::stubsDirectoryPath() . DIRECTORY_SEPARATOR . Constants::CREATE_TABLE_STUB_NAME;
    }

    /**
     * @return string
     */
    public static function updateRelationsStubPath(): string
    {
        return MigrationsCreator::stubsDirectoryPath() . DIRECTORY_SEPARATOR . Constants::UPDATE_RELATIONS_STUB_NAME;
    }

    /**
     * @param string $model
     * @param string $relatedModel
     *
     * @return bool
     */
    public static function manyToManyMigrationExist(string $model, string $relatedModel): bool
    {
        $migrationClass         = self::manyToManyMigrationName($model, $relatedModel);
        $reversedMigrationClass = self::manyToManyMigrationName($relatedModel, $model);

        return MigrationsCreator::migrationExists($migrationClass) || MigrationsCreator::migrationExists($reversedMigrationClass);
    }

}