<?php

namespace Tests\Schema\Parsers\Aggregators;

use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Aggregators\OneToMany;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Constants;
use Orchestra\Testbench\TestCase;

/**
 * Class ManyToManyTest
 *
 * @package Tests\Schema\Parsers\Aggregators
 */
class OneToManyTest extends TestCase
{
    /**
     * @return void
     */
    public function testAggregate(): void
    {
        $this->assertEquals(
            (new OneToMany)->aggregate(['Actor', 'Role']),
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