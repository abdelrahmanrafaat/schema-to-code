<?php

namespace Tests\Helpers;

use Abdelrahmanrafaat\SchemaToCode\Helpers\ModelHelpers;
use Orchestra\Testbench\TestCase;

/**
 * Class ModelHelpersTest
 *
 * @package Tests\Helpers
 */
class ModelHelpersTest extends TestCase
{
    /**
     * @return void
     */
    public function testNormalizedModelsMap(): void
    {
        $this->assertEquals(
            ModelHelpers::normalizedModelsMap(['users', '  actors ', 'user_type', 'User']),
            ['User', 'Actor', 'UserType']
        );
    }

    /**
     * @return void
     */
    public function testNormalizeModel(): void
    {
        $this->assertEquals(ModelHelpers::normalizeModel('users'), 'User');
        $this->assertEquals(ModelHelpers::normalizeModel(' Actors '), 'Actor');
        $this->assertEquals(ModelHelpers::normalizeModel('  user_types '), 'UserType');
    }

    /**
     * @return void
     */
    public function testNormalizedRelationSymbolsMap(): void
    {
        $this->assertEquals(
            ModelHelpers::normalizedRelationSymbolsMap(['  1  ', ' m  ', ' M']),
            ['1', 'm', 'm']
        );
    }

    /**
     * @return void
     */
    public function testNormalizeRelationSymbol(): void
    {
        $this->assertEquals(ModelHelpers::normalizeRelationSymbol(' 1 '), '1');
        $this->assertEquals(ModelHelpers::normalizeRelationSymbol('   M '), 'm');
        $this->assertEquals(ModelHelpers::normalizeRelationSymbol('   m '), 'm');
    }

    /**
     * @return void
     */
    public function testModelNameToTableName(): void
    {
        $this->assertEquals(ModelHelpers::modelNameToTableName('User'), 'users');
        $this->assertEquals(ModelHelpers::modelNameToTableName('Actor'), 'actors');
        $this->assertEquals(ModelHelpers::modelNameToTableName('userType'), 'user_types');
    }

    /**
     * @return void
     */
    public function testModelNameToForeignKey(): void
    {
        $this->assertEquals(ModelHelpers::modelNameToForeignKey('User'), 'user_id');
        $this->assertEquals(ModelHelpers::modelNameToForeignKey('Product'), 'product_id');
        $this->assertEquals(ModelHelpers::modelNameToForeignKey('UserType'), 'user_type_id');
    }

    /**
     * @return void
     */
    public function testModelNameToMethodName(): void
    {
        $this->assertEquals(ModelHelpers::modelNameToMethodName('User'), 'user');
        $this->assertEquals(ModelHelpers::modelNameToMethodName('UserType'), 'userType');

        $this->assertEquals(ModelHelpers::modelNameToMethodName('User', true), 'users');
        $this->assertEquals(ModelHelpers::modelNameToMethodName('UserType', true), 'userTypes');
    }

}