<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Parsers;

/**
 * Interface RelationsSymbolsParserInterface
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Parsers
 */
interface RelationsSymbolsParserInterface
{
    /**
     * @param string $relationLine
     * @param int    $lineNumber
     *
     * @return array
     */
    public function parse(string $relationLine, int $lineNumber): array;
}