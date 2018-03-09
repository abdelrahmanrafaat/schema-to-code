<?php

namespace Tests\Helpers;

use Abdelrahmanrafaat\SchemaToCode\Helpers\ArrayHelpers;
use Orchestra\Testbench\TestCase;

/**
 * Class ArrayHelpersTest
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Tests\Helpers
 */
class ArrayHelpersTest extends TestCase
{
    /**
     * @return void
     */
    public function testFilterEmptyLines(): void
    {
        $lines = [
            '',
            '   ',
            '       ',
            'not empty',
        ];

        $notEmptyLines = ArrayHelpers::filterEmptyLines($lines);
        $this->assertEquals(count($notEmptyLines), 1);

        $allEmpty = [
            '',
            '   ',
            '       ',
        ];
        $this->assertEmpty(ArrayHelpers::filterEmptyLines($allEmpty));
    }

    /**
     * @return void
     */
    public function testColonImplode(): void
    {
        $pieces = [
            'a', 'b', 'c',
        ];
        $this->assertEquals(ArrayHelpers::colonImplode($pieces), 'a:b:c');

        $this->assertEquals(ArrayHelpers::colonImplode([]), '');
    }

    /**
     * @return void
     */
    public function testCommaImplode(): void
    {
        $pieces = [
            'a', 'b', 'c',
        ];
        $this->assertEquals(ArrayHelpers::commaImplode($pieces), 'a,b,c');

        $this->assertEquals(ArrayHelpers::commaImplode([]), '');
    }

    /**
     * @return void
     */
    public function testRevers(): void
    {
        $this->assertEquals(ArrayHelpers::reverse([1, 2, 3]), [3, 2, 1]);
        $this->assertEquals(ArrayHelpers::reverse(['1', '2', '3']), ['3', '2', '1']);

        $this->assertEquals(ArrayHelpers::reverse([]), []);
    }

    /**
     * @return void
     */
    public function testSearch(): void
    {
        $this->assertEquals(ArrayHelpers::search(1, [1, 2, 3, 4, 5]), 0);
        $this->assertEquals(ArrayHelpers::search(2, [1, 2, 3, 4, 5]), 1);

        $this->assertEquals(ArrayHelpers::search('don`tExist', [1, 2, 3, 4, 5]), -1);
        $this->assertEquals(ArrayHelpers::search(-1, [1, 2, 3, 4, 5]), -1);
    }

    /**
     * @return void
     */
    public function testUnique(): void
    {
        $this->assertEquals(
            ArrayHelpers::unique([1, 1, 2, 2, 3, 3, 4, 5]),
            [0 => 1, 2 => 2, 4 => 3, 6 => 4, 7 => 5]
        );
        $this->assertEquals(ArrayHelpers::unique([1, 2, 3, 4, 5]), [1, 2, 3, 4, 5]);
    }
}