<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Tables\Template;

use Abdelrahmanrafaat\SchemaToCode\Helpers\MigrationHelpers;
use Abdelrahmanrafaat\SchemaToCode\Helpers\ModelHelpers;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Constants;

/**
 * Class Builder
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Tables\Template
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
}