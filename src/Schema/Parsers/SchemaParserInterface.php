<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Parsers;

/**
 * Interface SchemaParserInterface
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Parsers
 */
interface SchemaParserInterface
{
    /**
     * @param string $schema
     *
     * @return array
     */
    public function parse(string $schema): array;
}