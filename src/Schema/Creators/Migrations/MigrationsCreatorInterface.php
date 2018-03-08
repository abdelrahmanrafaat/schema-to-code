<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations;

/**
 * Interface MigrationsCreatorInterface
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations
 */
interface MigrationsCreatorInterface
{
    /**
     * @param string $model
     */
    public function createTable(string $model): void;

    /**
     * @param string $model
     * @param array  $relations
     */
    public function createRelations(string $model, array $relations): void;
}