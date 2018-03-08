<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Parsers;

use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Aggregators\RelationsAggregatorInterface;

/**
 * Class RelationsParser
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Parsers
 */
class RelationsParser implements RelationsParserInterface
{
    protected $relationsSymbolsParser;
    protected $relationsAggregator;

    /**
     * RelationsParser constructor.
     *
     * @param \Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\RelationsSymbolsParserInterface          $relationsSymbolsParser
     * @param \Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Aggregators\RelationsAggregatorInterface $relationsAggregator
     */
    public function __construct(RelationsSymbolsParserInterface $relationsSymbolsParser, RelationsAggregatorInterface $relationsAggregator)
    {
        $this->relationsSymbolsParser = $relationsSymbolsParser;
        $this->relationsAggregator    = $relationsAggregator;
    }

    /**
     * @param string $relationLine
     * @param int    $lineNumber
     * @param array  $models
     *
     * @return array
     */
    public function parse(string $relationLine, int $lineNumber, array $models): array
    {
        $relationSymbols = $this->relationsSymbolsParser->parse($relationLine, $lineNumber);
        $relation        = $this->relationsAggregator->aggregate($relationSymbols, $models);

        return $relation;
    }
}