<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Relations;

/**
 * Interface CreatorInterface
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Relations
 */
interface CreatorInterface
{
    /**
     * @param string $model
     * @param array  $belongsToRelations
     *
     * @return string
     */
    public function createBelongsToRelations(string $model, array $belongsToRelations): string;

    /**
     * @param string $model
     * @param array  $belongsToManyRelations
     *
     * @return array
     */
    public function createBelongsToManyRelations(string $model, array $belongsToManyRelations): array;
}