<?php

namespace Tests\Schema\Parsers;

use Orchestra\Testbench\TestCase;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\ModelsParser;
use Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Parsers\InvalidModelsSyntax;

/**
 * Class ModelsParserTest
 *
 * @package Tests\Schema\Parsers
 */
class ModelsParserTest extends TestCase
{
    /**
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Parsers\InvalidModelsSyntax
     *
     * @return void
     */
    public function testParse(): void
    {
        $this->assertEquals(
            (new ModelsParser)->parse('users:admins', 1),
            ['User', 'Admin']
        );

        $this->assertEquals(
            (new ModelsParser)->parse('user type:role', 1),
            ['UserType', 'Role']
        );

    }

    /**
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Parsers\InvalidModelsSyntax
     *
     * @return void
     */
    public function testEmptyModelThrowsException(): void
    {
        $this->expectException(InvalidModelsSyntax::class);
        (new ModelsParser)->parse(':', 1);
    }

    /**
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Parsers\InvalidModelsSyntax
     *
     * @return void
     */
    public function testLessThanTwoModelsPerLineThrowsException(): void
    {
        $this->expectException(InvalidModelsSyntax::class);
        (new ModelsParser)->parse('User', 1);
    }

    /**
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Parsers\InvalidModelsSyntax
     *
     * @return void
     */
    public function testMoreThanTwoModelsPerLineThrowsException(): void
    {
        $this->expectException(InvalidModelsSyntax::class);
        (new ModelsParser)->parse('User:Profile:Favourites', 1);
    }
}