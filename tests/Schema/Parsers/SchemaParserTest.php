<?php

namespace Tests\Schema\Parsers;

use Orchestra\Testbench\TestCase;
use Illuminate\Filesystem\Filesystem;
use Abdelrahmanrafaat\SchemaToCode\Helpers\LocalFileHelpers;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\SchemaParser;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Constants;
use Abdelrahmanrafaat\SchemaToCode\Schema\Getters\Local\Getter;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\ModelsParser;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\ModelsManager;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\RelationsParser;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\RelationsSymbolsParser;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Aggregators\RelationsAggregator;

/**
 * Class SchemaParserTest
 *
 * @package Tests\Schema\Parsers
 */
class SchemaParserTest extends TestCase
{
    public function testParse(): void
    {
        $fileSystemMock = $this->getMockBuilder(Filesystem::class)->getMock();
        $fileSystemMock->method('get')
                       ->willReturn('User:Profile
                                    1:1
                                    
                                    User:Actor
                                    1:1
                                    
                                    Actor:Movie
                                    M:m
                                    
                                    Movie:Review
                                    1:M
                                    
                                    Review:User
                                    M:1
                       ');
        $fileSystemMock->method('exists')->willReturn(true);
        $fileSystemMock->method('isFile')->willReturn(true);
        $fileSystemMock->method('isReadable')->willReturn(true);
        $fileSystemMock->method('extension')->willReturn('txt');

        $localFileHelpers = new LocalFileHelpers($fileSystemMock, '');
        $schema           = (new Getter($localFileHelpers))->get();

        $parsedSchema = (new SchemaParser(
            new ModelsParser, new RelationsParser(new RelationsSymbolsParser, new RelationsAggregator), new ModelsManager
        ))->parse($schema);

        $this->assertEquals(
            $parsedSchema,
            [
                'User'    => [
                    Constants::HAS_ONE         => ['Profile', 'Actor'],
                    Constants::BELONGS_TO      => [],
                    Constants::HAS_MANY        => ['Review'],
                    Constants::BELONGS_TO_MANY => [],
                ],
                'Profile' => [
                    Constants::HAS_ONE         => [],
                    Constants::BELONGS_TO      => ['User'],
                    Constants::HAS_MANY        => [],
                    Constants::BELONGS_TO_MANY => [],
                ],
                'Actor'   => [
                    Constants::HAS_ONE         => [],
                    Constants::BELONGS_TO      => ['User'],
                    Constants::HAS_MANY        => [],
                    Constants::BELONGS_TO_MANY => ['Movie'],
                ],
                'Movie'   => [
                    Constants::HAS_ONE         => [],
                    Constants::BELONGS_TO      => [],
                    Constants::HAS_MANY        => ['Review'],
                    Constants::BELONGS_TO_MANY => ['Actor'],
                ],
                'Review'  => [
                    Constants::HAS_ONE         => [],
                    Constants::BELONGS_TO      => ['Movie', 'User'],
                    Constants::HAS_MANY        => [],
                    Constants::BELONGS_TO_MANY => [],
                ],
            ]
        );
    }

}