<?php

namespace Tests\Schema\Getter\Local;

use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Aggregators\AggregatorFactory;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Aggregators\OneToOne;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Aggregators\OneToMany;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Aggregators\ManyToOne;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Aggregators\ManyToMany;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Constants;
use Orchestra\Testbench\TestCase;

/**
 * Class AggregatorFactoryTest
 *
 * @package Tests\Schema\Getter\Local
 */
class AggregatorFactoryTest extends TestCase
{
    /**
     * @return void
     */
    public function testMake(): void
    {
        $oneToOne   = [Constants::ONE_SYMBOL, Constants::ONE_SYMBOL];
        $oneToMany  = [Constants::ONE_SYMBOL, Constants::MANY_SYMBOL];
        $manyToOne  = [Constants::MANY_SYMBOL, Constants::ONE_SYMBOL];
        $manyToMany = [Constants::MANY_SYMBOL, Constants::MANY_SYMBOL];

        $aggregatorFactory = new AggregatorFactory;

        $this->assertInstanceOf(OneToOne::class, $aggregatorFactory->make($oneToOne));
        $this->assertInstanceOf(OneToMany::class, $aggregatorFactory->make($oneToMany));
        $this->assertInstanceOf(ManyToOne::class, $aggregatorFactory->make($manyToOne));
        $this->assertInstanceOf(ManyToMany::class, $aggregatorFactory->make($manyToMany));
    }
}