<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Parsers;

/**
 * Interface RelationsParserInterface
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Parsers
 */
interface RelationsParserInterface
{
    /**
     * @param string $relationLine
     * @param int    $lineNumber
     * @param array  $models
     *
     * @return array
     */
    public function parse(string $relationLine, int $lineNumber, array $models): array;
}