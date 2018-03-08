<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Relations;

use Abdelrahmanrafaat\SchemaToCode\Helpers\MigrationHelpers;
use Abdelrahmanrafaat\SchemaToCode\Helpers\StringHelpers;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\MigrationsCreator;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Template\BuilderInterface;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Constants;
use Illuminate\Filesystem\Filesystem;

/**
 * Class Creator
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Relations
 */
class Creator implements CreatorInterface
{
    /**
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $fileSystem;

    /**
     * @var \Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Template\BuilderInterface
     */
    protected $templatesBuilder;

    /**
     * Creator constructor.
     *
     * @param \Illuminate\Filesystem\Filesystem                             $fileSystem
     * @param \Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Template\BuilderInterface $templatesBuilder
     */
    public function __construct(Filesystem $fileSystem, BuilderInterface $templatesBuilder)
    {
        $this->fileSystem       = $fileSystem;
        $this->templatesBuilder = $templatesBuilder;
    }

    /**
     * @param string $model
     * @param array  $relations
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function createRelations(string $model, array $relations): void
    {
        if (!empty($relations[Constants::BELONGS_TO]))
            $this->createBelongsToRelations($model, $relations[Constants::BELONGS_TO]);

        $this->createBelongsToManyRelations($model, $relations[Constants::BELONGS_TO_MANY]);
    }

    /**
     * @param string $model
     * @param array  $belongsToRelations
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function createBelongsToRelations(string $model, array $belongsToRelations): void
    {
        $migrationName = MigrationHelpers::updateRelationsMigrationName($model);
        $templates     = $this->templatesBuilder->updateRelationsTemplate($model, $belongsToRelations);

        $stub          = StringHelpers::populateStub($this->fileSystem, MigrationHelpers::updateRelationsStubPath(), $templates);
        $migrationPath = MigrationHelpers::getMigrationPath($migrationName);

        $this->fileSystem->put($migrationPath, $stub);
        MigrationsCreator::addCreatedMigration($migrationName);
    }

    /**
     * @param string $model
     * @param array  $belongsToManyRelations
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function createBelongsToManyRelations(string $model, array $belongsToManyRelations)
    {

        foreach ($belongsToManyRelations as $relatedModel) {
            if (MigrationHelpers::manyToManyMigrationExist($model, $relatedModel))
                continue;

            $migrationName = MigrationHelpers::manyToManyMigrationName($model, $relatedModel);
            $templates     = $this->templatesBuilder->createManyToManyTableTemplate($model, $relatedModel);

            $stub          = StringHelpers::populateStub($this->fileSystem, MigrationHelpers::createTableStubPath(), $templates);
            $migrationPath = MigrationHelpers::getMigrationPath($migrationName);

            $this->fileSystem->put($migrationPath, $stub);
            MigrationsCreator::addCreatedMigration($migrationName);
        }
    }
}