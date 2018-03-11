<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\Template;

/**
 * Interface BuilderInterface
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\Template
 */
interface BuilderInterface
{
    /**
     * @param string $model
     * @param array  $relations
     *
     * @return array
     */
    public function createModelTemplate(string $model, array $relations): array;
}