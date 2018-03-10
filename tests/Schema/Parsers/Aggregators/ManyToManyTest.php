<?php

namespace Tests\Schema\Parsers\Aggregators;

use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Constants;
use Orchestra\Testbench\TestCase;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Aggregators\ManyToMany;

/**
 * Class ManyToManyTest
 *
 * @package Tests\Schema\Parsers\Aggregators
 */
class ManyToManyTest extends TestCase
{
    /**
     * @return void
     */
    public function testAggregate(): void
    {
        $this->assertEquals(
            (new ManyToMany)->aggregate(['Actor', 'Movie']),
            [
                'Actor' => [
                    Constants::BELONGS_TO_MANY => 'Movie',
                ],
                'Movie' => [
                    Constants::BELONGS_TO_MANY => 'Actor',
                ],
            ]
        );
    }

}