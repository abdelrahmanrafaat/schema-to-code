<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Aggregators;

/**
 * Interface RelationsAggregatorInterface
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Aggregators
 */
interface RelationsAggregatorInterface
{
    public function aggregate(array $relationSymbols, array $models): array;
}