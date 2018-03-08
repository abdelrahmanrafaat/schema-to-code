<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Aggregators;

use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Constants;

/**
 * Class ManyToOne
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Aggregators
 */
class ManyToOne implements AggregatorInterface
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
                Constants::BELONGS_TO => $models[1],
            ],
            $models[1] => [
                Constants::HAS_MANY => $models[0],
            ],
        ];
    }
}