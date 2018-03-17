<?php

namespace Tests\Schema\Creators\Migrations\Relations\Template;

use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Constants;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Relations\Template\Builder;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Relations\Template\MethodBuilder;
use Orchestra\Testbench\TestCase;

/**
 * Class BuilderTest
 *
 * @package Tests\Schema\Creators\Migrations\Relations\Template
 */
class BuilderTest extends TestCase
{
    protected $relationTemplateBuilder;

    /**
     * @return void
     */
    public function setUp()
    {
        $methodBuilderMock = $this->getMockBuilder(MethodBuilder::class)->getMock();
        $methodBuilderMock->method('belongsToTemplate')->willReturn('');
        $methodBuilderMock->method('belongsToManyTemplate')->willReturn('');

        $this->relationTemplateBuilder = new Builder($methodBuilderMock);
        parent::setUp();
    }

    /**
     * @return void
     */
    public function testUpdateRelationsTemplate(): void
    {
        $this->assertEquals(
            $this->relationTemplateBuilder->updateRelationsTemplate('User', []),
            [
                Constants::TABLE_NAME_TEMPLATE_KEY => 'users',
                Constants::CLASS_NAME_TEMPLATE_KEY => 'UpdateUsersRelations',
                Constants::RELATIONS_TEMPLATE_KEY  => '',
            ]
        );
    }

    /**
     * @return void
     */
    public function createManyToManyTableTemplate(): void
    {
        $this->assertEquals(
            $this->relationTemplateBuilder->updateRelationsTemplate('User', 'Actor'),
            [
                Constants::TABLE_NAME_TEMPLATE_KEY => 'actors_users',
                Constants::CLASS_NAME_TEMPLATE_KEY => 'CreateActorsUsersTable',
                Constants::RELATIONS_TEMPLATE_KEY  => '',
            ]
        );
    }
}