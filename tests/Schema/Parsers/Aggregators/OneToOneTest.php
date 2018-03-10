<?php

namespace Tests\Schema\Parsers\Aggregators;

use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Constants;
use Orchestra\Testbench\TestCase;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Aggregators\OneToOne;

/**
 * Class ManyToManyTest
 *
 * @package Tests\Schema\Parsers\Aggregators
 */
class OneToOneTest extends TestCase
{
    /**
     * @return void
     */
    public function testAggregate(): void
    {
        $this->assertEquals(
            (new OneToOne)->aggregate(['User', 'Profile']),
            [
                'User' => [
                    Constants::HAS_ONE => 'Profile',
                ],
                'Profile' => [
                    Constants::BELONGS_TO => 'User',
                ],
            ]
        );
    }
}