<?php

namespace Tests\Schema\Parsers\Aggregators;

use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Aggregators\ManyToOne;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Constants;
use Orchestra\Testbench\TestCase;

/**
 * Class ManyToManyTest
 *
 * @package Tests\Schema\Parsers\Aggregators
 */
class ManyToOneTest extends TestCase
{
    /**
     * @return void
     */
    public function testAggregate(): void
    {
        $this->assertEquals(
            (new ManyToOne)->aggregate(['Role', 'Actor']),
            [
                'Actor' => [
                    Constants::HAS_MANY => 'Role',
                ],
                'Role'  => [
                    Constants::BELONGS_TO => 'Actor',
                ],
            ]
        );
    }
}