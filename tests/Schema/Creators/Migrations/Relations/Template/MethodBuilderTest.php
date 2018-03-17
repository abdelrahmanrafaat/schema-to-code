<?php

namespace Tests\Schema\Creators\Migrations\Relations\Template;

use Abdelrahmanrafaat\SchemaToCode\Helpers\StringHelpers;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Relations\Template\MethodBuilder;
use Orchestra\Testbench\TestCase;

/**
 * Class MethodBuilderTest
 *
 * @package Tests\Schema\Creators\Migrations\Relations\Template
 */
class MethodBuilderTest extends TestCase
{
    /**
     * @return void
     */
    public function testBelongsToTemplate(): void
    {
        $methodBuilder = new MethodBuilder;

        $this->assertEquals(
            $methodBuilder->belongsToTemplate('User'),
            "\$table->integer('user_id')->unsigned();
            \$table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade'); " . PHP_EOL
        );
    }

    /**
     * @return void
     */
    public function testBelongsToManyTemplate(): void
    {
        $methodBuilder = new MethodBuilder;

        $this->assertEquals(
            $methodBuilder->belongsToManyTemplate('Actor', 'User'),
            "\$table->integer('actor_id')->unsigned();
            \$table->foreign('actor_id')
                ->references('id')
                ->on('actors')
                ->onDelete('cascade'); " . PHP_EOL . PHP_EOL .
            
            StringHelpers::repeat(StringHelpers::tab(), 3) . "\$table->integer('user_id')->unsigned();
            \$table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade'); " . PHP_EOL
        );
    }
}