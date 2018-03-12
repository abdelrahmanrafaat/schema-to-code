<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Relations\Template;

/**
 * Interface BuilderInterface
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations
 */
interface BuilderInterface
{
    /**
     * @param string $model
     * @param string $relatedModel
     *
     * @return array
     */
    public function createManyToManyTableTemplate(string $model, string $relatedModel): array;

    /**
     * @param string $model
     * @param array  $belongsToRelations
     *
     * @return array
     */
    public function updateRelationsTemplate(string $model, array $belongsToRelations): array;
}