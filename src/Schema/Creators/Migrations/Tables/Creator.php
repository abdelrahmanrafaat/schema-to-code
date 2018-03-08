<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Tables;

use Abdelrahmanrafaat\SchemaToCode\Helpers\MigrationHelpers;
use Abdelrahmanrafaat\SchemaToCode\Helpers\StringHelpers;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\MigrationsCreator;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Template\BuilderInterface;
use Illuminate\Filesystem\Filesystem;

/**
 * Class Creator
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Tables
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
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function createTable(string $model): void
    {
        $migrationName = MigrationHelpers::createTableMigrationName($model);
        $templates     = $this->templatesBuilder->createTableTemplate($model);

        $stub          = StringHelpers::populateStub($this->fileSystem, MigrationHelpers::createTableStubPath(), $templates);
        $migrationPath = MigrationHelpers::getMigrationPath($migrationName);

        $this->fileSystem->put($migrationPath, $stub);
        MigrationsCreator::addCreatedMigration($migrationName);
    }
}