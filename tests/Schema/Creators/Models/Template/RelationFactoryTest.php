<?php

namespace Tests\Schema\Creators\Models\Template;

use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\Template\ManyToManyRelation;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\Template\OnesRelation;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\Template\RelationFactory as ModelRelationTemplateFactory;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Constants as RelationConstants;
use Orchestra\Testbench\TestCase;

/**
 * Class RelationFactoryTest
 *
 * @package Tests\Schema\Creators\Models\Template
 */
class RelationFactoryTest extends TestCase
{
    /**
     * @return void
     */
    public function testMakeBuilder(): void
    {
        $modelRelationFactory = new ModelRelationTemplateFactory;

        $this->assertInstanceOf(
            ManyToManyRelation::class,
            $modelRelationFactory->makeBuilder(RelationConstants::BELONGS_TO_MANY, '', '')
        );

        $this->assertInstanceOf(
            OnesRelation::class,
            $modelRelationFactory->makeBuilder(RelationConstants::HAS_ONE, '', '')
        );

        $this->assertInstanceOf(
            OnesRelation::class,
            $modelRelationFactory->makeBuilder(RelationConstants::BELONGS_TO, '', '')
        );

        $this->assertInstanceOf(
            OnesRelation::class,
            $modelRelationFactory->makeBuilder(RelationConstants::HAS_MANY, '', '')
        );
     }
}