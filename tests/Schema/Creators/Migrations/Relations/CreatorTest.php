<?php

namespace Tests\Schema\Creators\Migrations\Relations;

use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Relations\Template\Builder as MigrationsTemplateBuilder;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Relations\Creator as RelationsCreator;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Relations\Template\MethodBuilder;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\MigrationsCreator;
use Illuminate\Filesystem\Filesystem;
use Orchestra\Testbench\TestCase;

/**
 * Class CreatorTest
 *
 * @package Tests\Schema\Creators\Migrations\Relations
 */
class CreatorTest extends TestCase
{
    /**
     * @var RelationsCreator
     */
    protected $relationsCreator;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $fileSystemMock = $this->getMockBuilder(Filesystem::class)->getMock();
        $fileSystemMock->method('put')->willReturn(1);
        $fileSystemMock->method('get')->willReturn('');

        $relationsTemplateBuilder = new MigrationsTemplateBuilder(new MethodBuilder);
        $this->relationsCreator   = new RelationsCreator($fileSystemMock, $relationsTemplateBuilder);

        MigrationsCreator::resetCreatedMigrations();
        parent::setUp();
    }

    /**
     * @return void
     */
    public function testCreateBelongsToRelations(): void
    {
        $this->assertEquals(
            $this->relationsCreator->createBelongsToRelations('user', []),
            'update_users_relations'
        );

        $this->assertEquals(
            $this->relationsCreator->createBelongsToRelations('profile', []),
            'update_profiles_relations'
        );
    }

    /**
     * @return void
     */
    public function testCreateBelongsToManyRelations(): void
    {
        $manyToManyMigrations = $this->relationsCreator->createBelongsToManyRelations('Actor', ['Movie', 'Role']);

        $this->assertCount(
            2,
            $manyToManyMigrations
        );

        $this->assertTrue(
            in_array('create_actors_movies_table', $manyToManyMigrations)
        );

        $this->assertTrue(
            in_array('create_actors_roles_table', $manyToManyMigrations)
        );
    }
}