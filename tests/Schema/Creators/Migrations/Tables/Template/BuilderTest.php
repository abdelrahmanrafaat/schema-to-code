<?php

namespace Tests\Schema\Creators\Migrations\Tables\Template;

use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Tables\Template\Builder;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Constants;
use Orchestra\Testbench\TestCase;

/**
 * Class BuilderTest
 *
 * @package Tests\Schema\Creators\Migrations\Tables\Template
 */
class BuilderTest extends TestCase
{
    /**
     * @return void
     */
    public function testCreateTableTemplate(): void
    {
        $tableTemplateBuilder = new Builder;

        $this->assertEquals(
            $tableTemplateBuilder->createTableTemplate('User'),
            [
                Constants::TABLE_NAME_TEMPLATE_KEY => 'users',
                Constants::CLASS_NAME_TEMPLATE_KEY => 'CreateUsersTable',
                Constants::RELATIONS_TEMPLATE_KEY  => '',
            ]
        );
    }

}