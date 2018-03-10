<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations;

use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Relations\CreatorInterface as RelationsCreatorInterface;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Tables\CreatorInterface as TablesCreatorInterface;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Constants;

/**
 * Class MigrationsCreator
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations
 */
class MigrationsCreator implements MigrationsCreatorInterface
{
    /**
     * @var \Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Tables\CreatorInterface
     */
    protected $tablesCreator;

    /**
     * @var \Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Relations\Creator
     */
    protected $relationsCreator;

    /**
     * @var array
     */
    protected static $createdMigrations = [];

    /**
     * MigrationsCreator constructor.
     *
     * @param \Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Tables\CreatorInterface $tablesCreator
     * @param \Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Relations\Creator       $relationsCreator
     */
    public function __construct(TablesCreatorInterface $tablesCreator, RelationsCreatorInterface $relationsCreator)
    {
        $this->tablesCreator    = $tablesCreator;
        $this->relationsCreator = $relationsCreator;
    }

    /**
     * @param string $model
     */
    public function createTable(string $model): void
    {
        self::addCreatedMigration($this->tablesCreator->createTable($model));
    }

    /**
     * @param string $model
     * @param array  $relations
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function createRelations(string $model, array $relations): void
    {
        if (!empty($relations[Constants::BELONGS_TO])) {
            $belongsToRelations = $this->relationsCreator->createBelongsToRelations($model, $relations[Constants::BELONGS_TO]);
            self::addCreatedMigration($belongsToRelations);
        }

        $manyToManyMigrations = $this->relationsCreator->createBelongsToManyRelations($model, $relations[Constants::BELONGS_TO_MANY]);
        foreach ($manyToManyMigrations as $migration)
            self::addCreatedMigration($migration);
    }

    /**
     * @return string
     */
    public static function stubsDirectoryPath(): string
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'stubs';
    }

    /**
     * @param string $migrationName
     */
    public static function addCreatedMigration(string $migrationName): void
    {
        self::$createdMigrations[] = $migrationName;
    }

    /**
     * @return array
     */
    public static function getCreatedMigrations(): array
    {
        return self::$createdMigrations;
    }

    /**
     * @param string $migrationName
     *
     * @return bool
     */
    public static function migrationExists(string $migrationName): bool
    {
        return in_array($migrationName, self::getCreatedMigrations());
    }

}

