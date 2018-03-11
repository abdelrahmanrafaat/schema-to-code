<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Template;

use Abdelrahmanrafaat\SchemaToCode\Helpers\MigrationHelpers;
use Abdelrahmanrafaat\SchemaToCode\Helpers\ModelHelpers;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Constants;

/**
 * Class Builder
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Relations
 */
class Builder implements BuilderInterface
{
    /**
     * @param string $model
     *
     * @return array
     */
    public function createTableTemplate(string $model): array
    {
        $migrationName  = MigrationHelpers::createTableMigrationName($model);
        $migrationClass = MigrationHelpers::getClassName($migrationName);

        return [
            Constants::TABLE_NAME_TEMPLATE_KEY => ModelHelpers::modelNameToTableName($model),
            Constants::CLASS_NAME_TEMPLATE_KEY => $migrationClass,
            Constants::RELATIONS_TEMPLATE_KEY  => '',
        ];
    }

    /**
     * @param string $model
     * @param string $relatedModel
     *
     * @return array
     */
    public function createManyToManyTableTemplate(string $model, string $relatedModel): array
    {
        $migrationName  = MigrationHelpers::manyToManyMigrationName($model, $relatedModel);
        $migrationClass = MigrationHelpers::getClassName($migrationName);

        return [
            Constants::TABLE_NAME_TEMPLATE_KEY => MigrationHelpers::manyToManyTableName($model, $relatedModel),
            Constants::CLASS_NAME_TEMPLATE_KEY => $migrationClass,
            Constants::RELATIONS_TEMPLATE_KEY  => $this->getBelongsToManyTemplate($model, $relatedModel),
        ];
    }

    /**
     * @param string $model
     * @param array  $belongsToRelations
     *
     * @return array
     */
    public function updateRelationsTemplate(string $model, array $belongsToRelations): array
    {
        $migrationName  = MigrationHelpers::updateRelationsMigrationName($model);
        $migrationClass = MigrationHelpers::getClassName($migrationName);

        $relations = '';
        foreach ($belongsToRelations as $index => $relatedModel)
            $relations .= $this->getBelongsToTemplate($relatedModel, $index);

        return [
            Constants::TABLE_NAME_TEMPLATE_KEY => ModelHelpers::modelNameToTableName($model),
            Constants::CLASS_NAME_TEMPLATE_KEY => $migrationClass,
            Constants::RELATIONS_TEMPLATE_KEY  => $relations,
        ];
    }

    /**
     * @param string $model
     * @param bool   $withIndentation
     *
     * @return string
     */
    protected function getBelongsToTemplate(string $model, bool $withIndentation = false): string
    {
        $newLine     = PHP_EOL;
        $tableName   = ModelHelpers::modelNameToTableName($model);
        $foreignKey  = ModelHelpers::modelNameToForeignKey($model);
        $indentation = ($withIndentation) ? $newLine . str_repeat(chr(9), 3) : '';

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
    protected function getBelongsToManyTemplate(string $model, string $relatedModel): string
    {
        return $this->getBelongsToTemplate($model) . $this->getBelongsToTemplate($relatedModel, true);
    }
}