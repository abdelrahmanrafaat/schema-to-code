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
     * @param \Illuminate\Filesystem\Filesystem                                                    $fileSystem
     * @param \Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Template\BuilderInterface $templatesBuilder
     */
    public function __construct(Filesystem $fileSystem, BuilderInterface $templatesBuilder)
    {
        $this->fileSystem       = $fileSystem;
        $this->templatesBuilder = $templatesBuilder;
    }

    /**
     * @param string $model
     * @param array  $belongsToRelations
     *
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function createBelongsToRelations(string $model, array $belongsToRelations): string
    {
        $migrationName = MigrationHelpers::updateRelationsMigrationName($model);
        $templates     = $this->templatesBuilder->updateRelationsTemplate($model, $belongsToRelations);

        $stub = StringHelpers::populateStub($this->fileSystem, MigrationHelpers::updateRelationsStubPath(), $templates);
        $this->createMigrationFile($migrationName, $stub);

        return $migrationName;
    }

    /**
     * @param string $model
     * @param array  $belongsToManyRelations
     *
     * @return array
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function createBelongsToManyRelations(string $model, array $belongsToManyRelations): array
    {
        $createdMigrations = [];
        foreach ($belongsToManyRelations as $relatedModel) {
            if (MigrationHelpers::manyToManyMigrationExist($model, $relatedModel))
                continue;

            $migrationName = MigrationHelpers::manyToManyMigrationName($model, $relatedModel);
            $templates     = $this->templatesBuilder->createManyToManyTableTemplate($model, $relatedModel);

            $stub = StringHelpers::populateStub($this->fileSystem, MigrationHelpers::createTableStubPath(), $templates);
            $this->createMigrationFile($migrationName, $stub);

            $createdMigrations[] = $migrationName;
        }

        return $createdMigrations;
    }

    /**
     * @param string $migrationName
     * @param string $stub
     *
     * @return void
     */
    protected function createMigrationFile(string $migrationName, string $stub): void
    {
        $migrationPath = MigrationHelpers::getMigrationPath($migrationName);
        $this->fileSystem->put($migrationPath, $stub);
    }

}