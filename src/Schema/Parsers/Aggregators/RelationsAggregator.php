<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Aggregators;

/**
 * Class RelationsAggregator
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Aggregators
 */
class RelationsAggregator implements RelationsAggregatorInterface
{
    /**
     * @param array $relationSymbols
     * @param array $models
     *
     * @return array
     */
    public function aggregate(array $relationSymbols, array $models): array
    {
        return (new AggregatorFactory)->make($relationSymbols)->aggregate($models);
    }
}
