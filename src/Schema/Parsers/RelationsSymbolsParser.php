<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Parsers;

use Abdelrahmanrafaat\SchemaToCode\Helpers\ArrayHelpers;
use Abdelrahmanrafaat\SchemaToCode\Helpers\ModelHelpers;
use Abdelrahmanrafaat\SchemaToCode\Helpers\StringHelpers;
use Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Parsers\InvalidRelationsSyntax;

/**
 * Class RelationsSymbolsParser
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Parsers
 */
class RelationsSymbolsParser implements RelationsSymbolsParserInterface
{
    /**
     * @param string $relationLine
     * @param int    $lineNumber
     *
     * @return array
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Parsers\InvalidRelationsSyntax
     */
    public function parse(string $relationLine, int $lineNumber): array
    {
        $relationSymbols = ModelHelpers::normalizedRelationSymbolsMap(StringHelpers::colonExplode($relationLine));
        $this->validate($relationSymbols, $lineNumber);

        return $relationSymbols;
    }

    /**
     * @param array $relationSymbols
     * @param int   $lineNumber
     *
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Parsers\InvalidRelationsSyntax
     */
    protected function validate(array $relationSymbols, int $lineNumber): void
    {
        if (!$this->isValidRelationSymbols($relationSymbols))
            Throw new InvalidRelationsSyntax($lineNumber);
    }

    /**
     * @param array $relationSymbol
     *
     * @return bool
     */
    protected function isValidRelationSymbols(array $relationSymbol): bool
    {
        return in_array(ArrayHelpers::colonImplode($relationSymbol), Constants::RELATION_SYMBOLS);
    }

}