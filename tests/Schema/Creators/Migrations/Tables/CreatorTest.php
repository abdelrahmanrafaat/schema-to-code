<?php

namespace Tests\Schema\Creators\Migrations\Tables;

use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Tables\Template\Builder as TablesTemplateBuilder;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Tables\Creator as TablesCreator;
use Illuminate\Filesystem\Filesystem;
use Orchestra\Testbench\TestCase;


/**
 * Class CreatorTest
 *
 * @package Tests\Schema\Creators\Migrations\Tables
 */
class CreatorTest extends TestCase
{
    /**
     * @return void
     */
    public function testCreate(): void
    {
        $fileSystemMock = $this->getMockBuilder(Filesystem::class)->getMock();
        $fileSystemMock->method('put')->willReturn(1);
        $fileSystemMock->method('get')->willReturn('');

        $tablesTemplateBuilder = new TablesTemplateBuilder;
        $tablesCreator         = new TablesCreator($fileSystemMock, $tablesTemplateBuilder);

        $this->assertEquals($tablesCreator->createTable('User'), 'create_users_table');
        $this->assertEquals($tablesCreator->createTable('Movie'), 'create_movies_table');
    }
}