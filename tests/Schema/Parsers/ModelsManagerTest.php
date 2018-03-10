<?php

namespace Tests\Schema\Parsers;

use Orchestra\Testbench\TestCase;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\ModelsManager;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Constants;

/**
 * Class ModelsManagerTest
 *
 * @package Tests\Schema\Parsers
 */
class ModelsManagerTest extends TestCase
{
    /**
     * @return void
     */
    public function testGroupByModels(): void
    {
        $relations = [
            [
                'User'    => [
                    Constants::HAS_ONE => 'Profile',
                ],
                'Profile' => [
                    Constants::BELONGS_TO => 'User',
                ],
            ],

            [
                'User'  => [
                    Constants::HAS_ONE => 'Actor',
                ],
                'Actor' => [
                    Constants::BELONGS_TO => 'User',
                ],
            ],

            [
                'Actor' => [
                    Constants::BELONGS_TO_MANY => 'Movie',
                ],
                'Movie' => [
                    Constants::BELONGS_TO_MANY => 'Actor',
                ],
            ],

            [
                'Movie'  => [
                    Constants::HAS_MANY => 'Review',
                ],
                'Review' => [
                    Constants::BELONGS_TO => 'Movie',
                ],
            ],

            [
                'Review' => [
                    Constants::BELONGS_TO => 'User',
                ],
                'User'   => [
                    Constants::HAS_MANY => 'Review',
                ],
            ],
        ];

        $groupedRelations = [
            'User' => [
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
            'Actor' => [
                Constants::HAS_ONE         => [],
                Constants::BELONGS_TO      => ['User'],
                Constants::HAS_MANY        => [],
                Constants::BELONGS_TO_MANY => ['Movie'],
            ],
            'Movie' => [
                Constants::HAS_ONE         => [],
                Constants::BELONGS_TO      => [],
                Constants::HAS_MANY        => ['Review'],
                Constants::BELONGS_TO_MANY => ['Actor'],
            ],
            'Review' => [
                Constants::HAS_ONE         => [],
                Constants::BELONGS_TO      => ['Movie', 'User'],
                Constants::HAS_MANY        => [],
                Constants::BELONGS_TO_MANY => [],
            ],
        ];

        $this->assertEquals((new ModelsManager)->groupByModels($relations), $groupedRelations);
    }
}