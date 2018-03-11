<?php

namespace Tests\Data;

use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Constants;

/**
 * Class Provider
 *
 * @package Tests\Data
 */
class Provider
{
    /**
     * @return array
     */
    public function parsedSchema(): array
    {
        return [
            'User'    => [
                Constants::HAS_ONE         => ['Profile', 'Actor'],
                Constants::BELONGS_TO      => [],
                Constants::HAS_MANY        => ['Review'],
                Constants::BELONGS_TO_MANY => [],
            ],
            'Profile' => [
                Constants::HAS_ONE         => [],
                Constants::BELONGS_TO      => ['User'],
                Constants::HAS_MANY        => [],
                Constants::BELONGS_TO_MANY => [],
            ],
            'Actor'   => [
                Constants::HAS_ONE         => [],
                Constants::BELONGS_TO      => ['User'],
                Constants::HAS_MANY        => [],
                Constants::BELONGS_TO_MANY => ['Movie'],
            ],
            'Movie'   => [
                Constants::HAS_ONE         => [],
                Constants::BELONGS_TO      => [],
                Constants::HAS_MANY        => ['Review'],
                Constants::BELONGS_TO_MANY => ['Actor'],
            ],
            'Review'  => [
                Constants::HAS_ONE         => [],
                Constants::BELONGS_TO      => ['Movie', 'User'],
                Constants::HAS_MANY        => [],
                Constants::BELONGS_TO_MANY => [],
            ],
        ];
    }

    /**
     * @return string
     */
    public function unParsedSchema():string
    {
        return file_get_contents(__DIR__ . '/schema.txt');
    }

}

