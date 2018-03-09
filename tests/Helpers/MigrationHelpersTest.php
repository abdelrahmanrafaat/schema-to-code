<?php

namespace Tests\Helpers;

use Abdelrahmanrafaat\SchemaToCode\Helpers\MigrationHelpers;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Constants;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\MigrationsCreator;
use Orchestra\Testbench\TestCase;
use Carbon\Carbon;
use Exception;

/**
 * Class MigrationHelpersTest
 *
 * @package Tests\Helpers
 */
class MigrationHelpersTest extends TestCase
{

    /**
     * @return void
     */
    public function testGetClassName(): void
    {
        $this->assertEquals(MigrationHelpers::getClassName('create_users_table'), 'CreateUsersTable');
        $this->assertEquals(MigrationHelpers::getClassName('create_users_movies_table'), 'CreateUsersMoviesTable');
        $this->assertEquals(MigrationHelpers::getClassName('users'), 'Users');
    }

    /**
     * @retun void
     */
    public function testGetDatePrefix(): void
    {
        $this->assertInstanceOf(
            Carbon::class,
            Carbon::createFromFormat(Constants::MIGRATION_DATEPREFIX_FORMAT, MigrationHelpers::getDatePrefix())
        );

        $invalidPrefixFormat = 'y-m-d-H';
        $this->expectException(Exception::class);
        Carbon::createFromFormat($invalidPrefixFormat, MigrationHelpers::getDatePrefix());
    }

    /**
     * @reutn void
     */
    public function testCreateTableMigrationName(): void
    {
        $this->assertEquals(MigrationHelpers::createTableMigrationName('User'), 'create_users_table');
        $this->assertEquals(MigrationHelpers::createTableMigrationName('UserType'), 'create_user_types_table');
    }

    /**
     * @return void
     */
    public function testUpdateRelationsMigrationName(): void
    {
        $this->assertEquals(MigrationHelpers::updateRelationsMigrationName('User'), 'update_users_relations');
        $this->assertEquals(MigrationHelpers::updateRelationsMigrationName('UserType'), 'update_user_types_relations');
    }

    /**
     * @return void
     */
    public function testManyToManyTableName(): void
    {
        $this->assertEquals(MigrationHelpers::manyToManyTableName('Actor', 'Movie'), 'actors_movies');
        $this->assertEquals(MigrationHelpers::manyToManyTableName('Review', 'Movie'), 'movies_reviews');
        $this->assertEquals(MigrationHelpers::manyToManyTableName('UserType', 'Role'), 'roles_user_types');
    }

    /**
     * @return void
     */
    public function testManyToManyMigrationName(): void
    {
        MigrationsCreator::addCreatedMigration('create_actors_movies_table');
        MigrationsCreator::addCreatedMigration('create_movies_reviews_table');

        $this->assertTrue(MigrationHelpers::manyToManyMigrationExist('Actor', 'Movie'));
        $this->assertTrue(MigrationHelpers::manyToManyMigrationExist('Review', 'Movie'));

        $this->assertFalse(MigrationHelpers::manyToManyMigrationExist('Don`t', 'Exist'));
    }

}