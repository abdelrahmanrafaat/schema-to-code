<?php

namespace Tests\Schema\Parsers;

use Orchestra\Testbench\TestCase;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\RelationsSymbolsParser;
use Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Parsers\InvalidRelationsSyntax;

/**
 * Class RelationsSymbolsParserTest
 *
 * @package Tests\Schema\Parsers
 */
class RelationsSymbolsParserTest extends TestCase
{
    /**
     * @return void
     */
    public function testInvalidSymbolsThrowsException(): void
    {
        $this->expectException(InvalidRelationsSyntax::class);
        (new RelationsSymbolsParser)->parse('x:y', 2);
    }

    /**
     * @return void
     */
    public function testParse(): void
    {
        $this->assertEquals(
            (new RelationsSymbolsParser)->parse(' 1 : 1 ', 2),
            ['1', '1']
        );

        $this->assertEquals(
            (new RelationsSymbolsParser)->parse(' 1 :  M  ', 2),
            ['1', 'm']
        );

        $this->assertEquals(
            (new RelationsSymbolsParser)->parse(' m : 1  ', 2),
            ['m', '1']
        );

        $this->assertEquals(
            (new RelationsSymbolsParser)->parse(' M:  M  ', 2),
            ['m', 'm']
        );
    }

}