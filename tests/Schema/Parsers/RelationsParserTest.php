<?php

namespace Tests\Schema\Parsers;

use Orchestra\Testbench\TestCase;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\RelationsParser;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\RelationsSymbolsParser;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Aggregators\RelationsAggregator;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Constants;

/**
 * Class RelationsParserTest
 *
 * @package Tests\Schema\Parsers
 */
class RelationsParserTest extends TestCase
{
    /**
     * @return void
     */
    public function testParse(): void
    {
        $this->assertEquals(
            (new RelationsParser(new RelationsSymbolsParser, new RelationsAggregator))->parse('1:1', 2, ['User', 'Account']),
            [
                'User' => [ Constants::HAS_ONE => 'Account'],
                'Account' => [ Constants::BELONGS_TO => 'User' ]
            ]
        );

        $this->assertEquals(
            (new RelationsParser(new RelationsSymbolsParser, new RelationsAggregator))->parse('1:M', 2, ['User', 'ProfilePicture']),
            [
                'User' => [ Constants::HAS_MANY => 'ProfilePicture'],
                'ProfilePicture' => [ Constants::BELONGS_TO => 'User' ]
            ]
        );

        $this->assertEquals(
            (new RelationsParser(new RelationsSymbolsParser, new RelationsAggregator))->parse('M:1', 2, ['ProfilePicture', 'User']),
            [
                'ProfilePicture' => [ Constants::BELONGS_TO => 'User' ],
                'User' => [ Constants::HAS_MANY => 'ProfilePicture'],
            ]
        );

        $this->assertEquals(
            (new RelationsParser(new RelationsSymbolsParser, new RelationsAggregator))->parse('M:M', 2, ['User', 'FavouriteMovie']),
            [
                'FavouriteMovie' => [ Constants::BELONGS_TO_MANY => 'User' ],
                'User' => [ Constants::BELONGS_TO_MANY => 'FavouriteMovie'],
            ]
        );
    }
}