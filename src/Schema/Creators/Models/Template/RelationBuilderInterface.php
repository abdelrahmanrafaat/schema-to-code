<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\Template;

/**
 * Interface RelationBuilderInterface
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\Template
 */
interface RelationBuilderInterface
{
    /**
     * @return string
     */
    public function getTemplate(): string;
}