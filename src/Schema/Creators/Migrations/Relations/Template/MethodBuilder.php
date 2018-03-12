<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Relations\Template;

use Abdelrahmanrafaat\SchemaToCode\Helpers\ModelHelpers;
use Abdelrahmanrafaat\SchemaToCode\Helpers\StringHelpers;

/**
 * Class MethodBuilder
 */
class MethodBuilder implements MethodBuilderInterface
{
    /**
     * @param string $model
     * @param bool   $withIndentation
     *
     * @return string
     */
    public function belongsToTemplate(string $model, bool $withIndentation = false): string
    {
        $newLine     = PHP_EOL;
        $tableName   = ModelHelpers::modelNameToTableName($model);
        $foreignKey  = ModelHelpers::modelNameToForeignKey($model);
        $indentation = ($withIndentation) ? $newLine . StringHelpers::repeat(StringHelpers::tab(), 3) : '';

        return "{$indentation}\$table->integer('{$foreignKey}')->unsigned();
            \$table->foreign('{$foreignKey}')
                ->references('id')
                ->on('{$tableName}')
                ->onDelete('cascade'); {$newLine}";
    }

    /**
     * @param string $model
     * @param string $relatedModel
     *
     * @return string
     */
    public function belongsToManyTemplate(string $model, string $relatedModel): string
    {
        return $this->belongsToTemplate($model) . $this->belongsToTemplate($relatedModel, true);
    }
}

