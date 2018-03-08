<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Parsers;

/**
 * Interface ModelsManagerInterface
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Parsers
 */
interface ModelsManagerInterface
{
    /**
     * @param array $relations
     *
     * @return array
     */
    public function groupByModels(array $relations): array;
}