<?php

namespace Tests\Schema\Creators;

use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Relations\Template\Builder as MigrationsTemplateBuilder;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Relations\Creator as RelationsCreator;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Tables\Template\Builder as TablesTemplateBuilder;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\ModelsCreator;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\Template\Builder as ModelsTemplateBuilder;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\Template\RelationFactory as ModelRelationBuilder;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Tables\Creator as TablesCreator;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Relations\Template\MethodBuilder;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\MigrationsCreator;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\CodeCreator;
use Illuminate\Filesystem\Filesystem;
use Orchestra\Testbench\TestCase;
use Tests\Data\Provider;

/**
 * Class CodeCreatorTest
 *
 * @package Tests\Schema\Creators
 */
class CodeCreatorTest extends TestCase
{
    /**
     * @return void
     */
    public function setUp():void
    {
        MigrationsCreator::resetCreatedMigrations();
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

        $parsedSchema = (new Provider)->parsedSchema();

        $modelsCreator = new ModelsCreator(
            $fileSystemMock, new ModelsTemplateBuilder(new ModelRelationBuilder)
        );

        $tablesTemplateBuilder    = new TablesTemplateBuilder;
        $tablesCreator            = new TablesCreator($fileSystemMock, $tablesTemplateBuilder);
        $relationsTemplateBuilder = new MigrationsTemplateBuilder(new MethodBuilder);
        $relationsCreator         = new RelationsCreator($fileSystemMock, $relationsTemplateBuilder);
        $migrationsCreator        = new MigrationsCreator($tablesCreator, $relationsCreator);

        (new CodeCreator($modelsCreator, $migrationsCreator))->create($parsedSchema);

        $createdModels = ModelsCreator::getCreatedModels();
        $this->assertCount(5, $createdModels);
        $this->assertCount(5, array_unique($createdModels));
        $this->assertTrue(in_array('User', $createdModels));
        $this->assertTrue(in_array('Actor', $createdModels));
        $this->assertTrue(in_array('Movie', $createdModels));
        $this->assertTrue(in_array('Review', $createdModels));
        $this->assertTrue(in_array('Profile', $createdModels));

        $createdMigrations = MigrationsCreator::getCreatedMigrations();
        $this->assertCount(9, $createdMigrations);
        $this->assertCount(9, array_unique($createdMigrations));
        $this->assertTrue(in_array('create_users_table', $createdMigrations));
        $this->assertTrue(in_array('create_profiles_table', $createdMigrations));
        $this->assertTrue(in_array('create_actors_table', $createdMigrations));
        $this->assertTrue(in_array('create_movies_table', $createdMigrations));
        $this->assertTrue(in_array('create_reviews_table', $createdMigrations));
        $this->assertTrue(in_array('update_profiles_relations', $createdMigrations));
        $this->assertTrue(in_array('update_actors_relations', $createdMigrations));
        $this->assertTrue(in_array('update_reviews_relations', $createdMigrations));
        $this->assertTrue(in_array('create_actors_movies_table', $createdMigrations));
    }

}