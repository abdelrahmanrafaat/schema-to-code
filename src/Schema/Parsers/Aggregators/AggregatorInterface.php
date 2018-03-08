<?php


namespace Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Aggregators;

/**
 * Interface AggregatorInterface
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Aggregators
 */
interface AggregatorInterface
{
    /**
     * @param array $models
     *
     * @return array
     */
    public function aggregate(array $models): array;
}