<?php

namespace Tests\Helpers;

use Abdelrahmanrafaat\SchemaToCode\Helpers\IntegersHelpers;
use Orchestra\Testbench\TestCase;

/**
 * Class IntegersHelpersTest
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Tests\Helpers
 */
class IntegersHelpersTest extends TestCase
{

    public function testIsEven(): void
    {
        $this->assertTrue(IntegersHelpers::isEven(0));
        $this->assertTrue(IntegersHelpers::isEven(2));
        $this->assertTrue(IntegersHelpers::isEven(4));
        $this->assertTrue(IntegersHelpers::isEven(-4));

        $this->assertFalse(IntegersHelpers::isEven(1));
        $this->assertFalse(IntegersHelpers::isEven(3));
        $this->assertFalse(IntegersHelpers::isEven(-5));
        $this->assertFalse(IntegersHelpers::isEven(-5));
    }

}