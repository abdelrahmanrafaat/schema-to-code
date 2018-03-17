<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Creators;

use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\MigrationsCreatorInterface;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\ModelsCreatorInterface;

/**
 * Class CodeCreator
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Creators
 */
class CodeCreator
{
    /**
     * @var \Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\ModelsCreatorInterface
     */
    protected $modelsCreator;

    /**
     * @var \Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\MigrationsCreatorInterface
     */
    protected $migrationsCreator;

    /**
     * CodeCreator constructor.
     *
     * @param \Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\ModelsCreatorInterface         $modelsCreator
     * @param \Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\MigrationsCreatorInterface $migrationsCreator
     */
    public function __construct(ModelsCreatorInterface $modelsCreator, MigrationsCreatorInterface $migrationsCreator)
    {
        $this->modelsCreator     = $modelsCreator;
        $this->migrationsCreator = $migrationsCreator;
    }

    /**
     * @param array $parsedSchema
     */
    public function create(array $parsedSchema): void
    {
        $this->createMigrations($parsedSchema);
        $this->createModels($parsedSchema);
    }

    /**
     * @param array $parsedSchema
     */
    protected function createMigrations(array $parsedSchema): void
    {
        foreach ($parsedSchema as $model => $relations)
            $this->migrationsCreator->createTable($model);

        foreach ($parsedSchema as $model => $relations)
            $this->migrationsCreator->createRelations($model, $relations);
    }

    /**
     * @param array $parsedSchema
     */
    protected function createModels(array $parsedSchema): void
    {
        foreach ($parsedSchema as $model => $relations){
            $this->modelsCreator->create($model, $relations);
        }
    }
}