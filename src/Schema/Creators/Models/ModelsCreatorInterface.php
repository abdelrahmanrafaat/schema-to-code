<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models;

/**
 * Interface ModelsCreatorInterface
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models
 */
interface ModelsCreatorInterface
{
    /**
     * @param string $model
     * @param array  $relations
     */
    public function create(string $model, array $relations): void;
}