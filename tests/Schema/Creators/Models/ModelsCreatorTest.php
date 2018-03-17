<?php

namespace Tests\Schema\Creators\Models;

use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\Template\Builder as ModelsTemplateBuilder;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\Template\RelationFactory as ModelRelationBuilder;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\ModelsCreator;
use Illuminate\Filesystem\Filesystem;
use Orchestra\Testbench\TestCase;

/**
 * Class ModelsCreatorTest
 *
 * @package Tests\Schema\Creators\Models
 */
class ModelsCreatorTest extends TestCase
{
    /**
     * @return void
     */
    public function setUp():void
    {
        ModelsCreator::resetCreatedModels();

        parent::setUp();
    }

    /**
     * @return void
     */
    public function testCreate(): void
    {
        $fileSystemMock = $this->getMockBuilder(Filesystem::class)->getMock();
        $fileSystemMock->method('put')->willReturn(1);
        $fileSystemMock->method('get')->willReturn('');

        $modelsCreator = new ModelsCreator(
            $fileSystemMock, new ModelsTemplateBuilder(new ModelRelationBuilder)
        );

        $modelsCreator->create('User', []);
        $modelsCreator->create('Profile', []);
        $modelsCreator->create('Movie', []);

        $createdModels = ModelsCreator::getCreatedModels();
        $this->assertCount(3, $createdModels);
        $this->assertTrue(in_array('User', $createdModels));
        $this->assertTrue(in_array('Profile', $createdModels));
        $this->assertTrue(in_array('Movie', $createdModels));
    }

}