<?php

namespace Tests\Schema\Creators\Models\Template;

use Abdelrahmanrafaat\SchemaToCode\Helpers\StringHelpers;
use Orchestra\Testbench\TestCase;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\Template\ManyToManyRelation as ManyToManyRelationTemplate;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Constants as RelationConstants;

/**
 * Class ManyToManyRelationTest
 *
 * @package Tests\Schema\Creators\Models\Template
 */
class ManyToManyRelationTest extends TestCase
{
    /**
     * @return void
     */
    public function testGetTemplate(): void
    {
        $hasOne = new ManyToManyRelationTemplate(RelationConstants::BELONGS_TO_MANY, 'Actor', 'Movie');

        $this->assertEquals(
            $hasOne->getTemplate(),
            StringHelpers::tab() . 'public function movies()' . PHP_EOL .
            StringHelpers::tab() . '{' . PHP_EOL .
            StringHelpers::tab() . StringHelpers::tab() . "return \$this->belongsToMany(Movie::class, 'actors_movies', 'actor_id', 'movie_id')->withTimestamps();" . PHP_EOL .
            StringHelpers::tab() . '}' . PHP_EOL . PHP_EOL
        );
    }
}