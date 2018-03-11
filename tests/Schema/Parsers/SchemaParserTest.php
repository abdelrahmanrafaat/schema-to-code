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
use Tests\Data\Provider;

/**
 * Class SchemaParserTest
 *
 * @package Tests\Schema\Parsers
 */
class SchemaParserTest extends TestCase
{
    /**
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local\ExtensionNotTxt
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local\NotFile
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local\NotFound
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local\NotReadable
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Parsers\EmptySchema
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Parsers\NotEvenLinesCount
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     *
     * @return void
     */
    public function testParse(): void
    {
        $dataProvider = new Provider;

        $fileSystemMock = $this->getMockBuilder(Filesystem::class)->getMock();
        $fileSystemMock->method('get')
                       ->willReturn($dataProvider->unParsedSchema());

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
            $dataProvider->parsedSchema()
        );
    }

}