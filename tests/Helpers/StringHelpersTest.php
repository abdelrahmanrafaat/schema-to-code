<?php

namespace Tests\Helpers;

use Orchestra\Testbench\TestCase;
use Abdelrahmanrafaat\SchemaToCode\Helpers\StringHelpers;
use Illuminate\Filesystem\Filesystem;

/**
 * Class StringHelpersTest
 *
 * @package Tests\Helpers
 */
class StringHelpersTest extends TestCase
{

    /**
     * @return void
     */
    public function testTrimSlashes(): void
    {
        $this->assertEquals(StringHelpers::trimSlashes('/very/long/path/'), 'very/long/path');
        $this->assertEquals(StringHelpers::trimSlashes('very/long/path/'), 'very/long/path');
        $this->assertEquals(StringHelpers::trimSlashes('/very/long/path'), 'very/long/path');
        $this->assertEquals(StringHelpers::trimSlashes('very/long/path'), 'very/long/path');
    }

    /**
     * @return void
     */
    public function testPlural(): void
    {
        $this->assertEquals(StringHelpers::plural('movie'), 'movies');
        $this->assertEquals(StringHelpers::plural('user'), 'users');
        $this->assertEquals(StringHelpers::plural('wolf'), 'wolves');
        $this->assertEquals(StringHelpers::plural('man'), 'men');
        $this->assertEquals(StringHelpers::plural('woman'), 'women');
    }

    /**
     * @return void
     */
    public function testSingular(): void
    {
        $this->assertEquals(StringHelpers::singular('movies'), 'movie');
        $this->assertEquals(StringHelpers::singular('users'), 'user');
        $this->assertEquals(StringHelpers::singular('wolves'), 'wolf');
        $this->assertEquals(StringHelpers::singular('men'), 'man');
        $this->assertEquals(StringHelpers::singular('women'), 'woman');
    }

    /**
     * @return void
     */
    public function testUpperCaseFirst(): void
    {
        $this->assertEquals(StringHelpers::upperCaseFirst('movie'), 'Movie');
        $this->assertEquals(StringHelpers::upperCaseFirst('user'), 'User');
        $this->assertEquals(StringHelpers::upperCaseFirst(''), '');
    }

    /**
     * @return void
     */
    public function testLowerCaseFirst(): void
    {
        $this->assertEquals(StringHelpers::lowerCaseFirst('Movie'), 'movie');
        $this->assertEquals(StringHelpers::lowerCaseFirst('User'), 'user');
        $this->assertEquals(StringHelpers::lowerCaseFirst(''), '');
    }

    /**
     * @return void
     */
    public function testIsEmpty(): void
    {
        $this->assertTrue(StringHelpers::isEmpty(' '));
        $this->assertTrue(StringHelpers::isEmpty('      '));
        $this->assertTrue(StringHelpers::isEmpty('
        '));

        $this->assertFalse(StringHelpers::isEmpty('a'));
    }

    /**
     * @return void
     */
    public function testToLinesArray(): void
    {
        $this->assertCount(
            3,
            StringHelpers::toLinesArray('X
                y
                z')
        );

        $this->assertCount(
            5,
            StringHelpers::toLinesArray('
                X
                y
                z
            ')
        );

        $this->assertCount(
            1,
            StringHelpers::toLinesArray('')
        );
    }

    /**
     * @return void
     */
    public function testColonExplode(): void
    {
        $this->assertEquals(StringHelpers::colonExplode('x:y'), ['x', 'y']);
        $this->assertEquals(StringHelpers::colonExplode('x::y'), ['x', '', 'y']);
        $this->assertEquals(StringHelpers::colonExplode(''), ['']);
    }

    /**
     * @return void
     */
    public function testLowerCase(): void
    {
        $this->assertEquals(StringHelpers::lowerCase('XyZ'), 'xyz');
        $this->assertEquals(StringHelpers::lowerCase('BBC'), 'bbc');
        $this->assertEquals(StringHelpers::lowerCase('abc'), 'abc');
    }

    /**
     * @return void
     */
    public function testCamelCase(): void
    {
        $this->assertEquals(StringHelpers::camelCase('my_name_is'), 'myNameIs');
        $this->assertEquals(StringHelpers::camelCase('loud-and-clear'), 'loudAndClear');
        $this->assertEquals(StringHelpers::camelCase('noConversion'), 'noConversion');
    }

    /**
     * @return void
     */
    public function testReplace(): void
    {
        $this->assertEquals(
            StringHelpers::replace('my name is ... and this name is ...', '...', 'mr/x'),
            'my name is mr/x and this name is mr/x'
        );

        $this->assertEquals(
            StringHelpers::replace('... is awsome', '...', 'php'),
            'php is awsome'
        );
    }

    /**
     * @return void
     */
    public function testSnakeCase(): void
    {
        $this->assertEquals(StringHelpers::snakeCase('myNameIs'), 'my_name_is');
        $this->assertEquals(StringHelpers::snakeCase('loud-and-clear'), 'loud-and-clear');
        $this->assertEquals(StringHelpers::snakeCase('no_conversion'), 'no_conversion');
    }

    /**
     * @return void
     */
    public function testRepeat(): void
    {
        $this->assertEquals(StringHelpers::repeat('x', 0), '');

        $this->assertEquals(StringHelpers::repeat('x', 1), 'x');
        $this->assertEquals(StringHelpers::repeat('x', 2), 'xx');
        $this->assertEquals(StringHelpers::repeat('x', 3), 'xxx');

        $this->assertEquals(StringHelpers::repeat(chr(9), 2),'		');
    }

    /**
     * @return void
     */
    public function testTab(): void
    {
        $this->assertEquals(StringHelpers::tab(), '	');
    }

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     *
     * @return void
     */
    public function testPopulateStub(): void
    {
        $fileSystemMock = $this->getMockBuilder(Filesystem::class)->getMock();
        $fileSystemMock->method('get')->willReturn('my name is dummyName my job is dummyJob');

        $this->assertEquals(
            StringHelpers::populateStub(
                $fileSystemMock,
                '',
                ['dummyName' => 'Abdelrahman', 'dummyJob' => 'SW Engineer']
            ),
            'my name is Abdelrahman my job is SW Engineer'
        );
    }
}