<?php

namespace Abdelrahmanrafaat\SchemaToCode\Helpers;

use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Constants;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\MigrationsCreator;
use Carbon\Carbon;
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
        $migrationsPath = self::getMigrationsDirectoryPath();

        return $migrationsPath . DIRECTORY_SEPARATOR . self::getDatePrefix() . '_' . $migrationName . '.php';
    }

    /**
     * @return string
     */
    public static function getMigrationsDirectoryPath(): string
    {
        return app()->databasePath('migrations');
    }

    /**
     * @return string
     */
    public static function getDatePrefix(): string
    {
        return Carbon::now()->format(Constants::MIGRATION_DATEPREFIX_FORMAT);
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

    /**
     * @param string $model
     * @param string $relatedModel
     *
     * @return string
     */
    public static function manyToManyTableName(string $model, string $relatedModel): string
    {
        $models = [$model, $relatedModel];
        sort($models);

        return ModelHelpers::modelNameToTableName($models[0]) . '_' . ModelHelpers::modelNameToTableName($models[1]);
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
        $migrationClass = self::manyToManyMigrationName($model, $relatedModel);

        return MigrationsCreator::migrationExists($migrationClass);
    }

}