<?php


namespace Abdelrahmanrafaat\SchemaToCode\Schema\Parsers;

/**
 * Interface ModelsParserInterface
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Parsers
 */
interface ModelsParserInterface
{
    /**
     * @param string $modelsLine
     * @param int    $lineNumber
     *
     * @return array
     */
    public function parse(string $modelsLine, int $lineNumber): array;
}