<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Template;

/**
 * Interface MethodBuilderInterface
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Template
 */
interface MethodBuilderInterface
{
    /**
     * @param string $model
     * @param bool   $withIndentation
     *
     * @return string
     */
    public function belongsToTemplate(string $model, bool $withIndentation = false): string;

    /**
     * @param string $model
     * @param string $relatedModel
     *
     * @return string
     */
    public function belongsToManyTemplate(string $model, string $relatedModel): string;
}