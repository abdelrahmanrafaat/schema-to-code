<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Aggregators;

use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Constants;

/**
 * Class OneToOne
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Aggregators
 */
class OneToOne implements AggregatorInterface
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
                Constants::HAS_ONE => $models[1],
            ],
            $models[1] => [
                Constants::BELONGS_TO => $models[0],
            ],
        ];
    }
}