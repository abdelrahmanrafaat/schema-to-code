<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Aggregators;

use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Constants;

/**
 * Class ManyToMany
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Aggregators
 */
class ManyToMany implements AggregatorInterface
{
    /**
     * @param array $models
     *
     * @return array
     */
    public function aggregate(array $models): array
    {
        return [
            $models[0] => [
                Constants::BELONGS_TO_MANY => $models[1],
            ],
            $models[1] => [
                Constants::BELONGS_TO_MANY => $models[0],
            ],
        ];
    }
}