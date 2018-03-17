<?php

namespace Tests\Schema\Creators\Models\Template;

use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Constants as TemplateConstants;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\Template\RelationFactory;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\Template\Builder;
use Illuminate\Console\DetectsApplicationNamespace;
use Orchestra\Testbench\TestCase;

/**
 * Class BuilderTest
 *
 * @package Tests\Schema\Creators\Models\Template
 */
class BuilderTest extends TestCase
{
    use DetectsApplicationNamespace;

    /**
     * @return void
     */
    public function testCreateModelTemplate(): void
    {
        $relationFactoryMock = $this->getMockBuilder(RelationFactory::class)->getMock();

        $builder = new Builder($relationFactoryMock);
        $this->assertEquals(
            $builder->createModelTemplate('User', []),
            [
                TemplateConstants::CLASS_NAME_TEMPLATE_KEY => 'User',
                TemplateConstants::TABLE_NAME_TEMPLATE_KEY => 'users',
                TemplateConstants::RELATIONS_TEMPLATE_KEY  => '',
                TemplateConstants::NAME_SPACE_TEMPLATE_KEY => trim($this->getAppNamespace(), '\\'),
            ]
        );

    }
}