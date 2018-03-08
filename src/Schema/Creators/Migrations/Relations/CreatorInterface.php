<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Relations;

/**
 * Interface CreatorInterface
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Relations
 */
interface CreatorInterface
{
    public function createRelations(string $model, array $relations) : void;
}