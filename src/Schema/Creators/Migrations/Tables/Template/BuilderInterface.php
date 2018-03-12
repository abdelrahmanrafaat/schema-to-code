<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Tables\Template;

/**
 * Interface BuilderInterface
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Tables\Template
 */
interface BuilderInterface
{
    /**
     * @param string $model
     *
     * @return array
     */
    public function createTableTemplate(string $model): array;
}