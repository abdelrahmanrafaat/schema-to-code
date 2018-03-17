<?php

namespace Tests\Schema\Creators\Models\Template;

use Abdelrahmanrafaat\SchemaToCode\Helpers\StringHelpers;
use Orchestra\Testbench\TestCase;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\Template\OnesRelation as OnesRelationTemplate;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Constants as RelationConstants;

/**
 * Class OnesRelationTest
 *
 * @package Tests\Schema\Creators\Models\Template
 */
class OnesRelationTest extends TestCase
{
    /**
     * @return void
     */
    public function testGetTemplate(): void
    {
        $hasOne    = new OnesRelationTemplate(RelationConstants::HAS_ONE, 'Profile');
        $belongsTo = new OnesRelationTemplate(RelationConstants::BELONGS_TO, 'Actor');
        $hasMany   = new OnesRelationTemplate(RelationConstants::HAS_MANY, 'Movie');

        $this->assertEquals(
            $hasOne->getTemplate(),
            StringHelpers::tab() . 'public function profile()' . PHP_EOL .
            StringHelpers::tab() . '{' . PHP_EOL .
            StringHelpers::tab() . StringHelpers::tab() . 'return $this->hasOne(Profile::class);' . PHP_EOL .
            StringHelpers::tab() . '}' . PHP_EOL . PHP_EOL
        );

        $this->assertEquals(
            $belongsTo->getTemplate(),
            StringHelpers::tab() . 'public function actor()' . PHP_EOL .
            StringHelpers::tab() . '{' . PHP_EOL .
            StringHelpers::tab() . StringHelpers::tab() . 'return $this->belongsTo(Actor::class);' . PHP_EOL .
            StringHelpers::tab() . '}' . PHP_EOL . PHP_EOL
        );

        $this->assertEquals(
            $hasMany->getTemplate(),
            StringHelpers::tab() . 'public function movies()' . PHP_EOL .
            StringHelpers::tab() . '{' . PHP_EOL .
            StringHelpers::tab() . StringHelpers::tab() . 'return $this->hasMany(Movie::class);' . PHP_EOL .
            StringHelpers::tab() . '}' . PHP_EOL . PHP_EOL
        );
    }
}