<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Relations\Template;

use Abdelrahmanrafaat\SchemaToCode\Helpers\MigrationHelpers;
use Abdelrahmanrafaat\SchemaToCode\Helpers\ModelHelpers;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Constants;

/**
 * Class Builder
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Relations\Template
 */
class Builder implements BuilderInterface
{
    /**
     * @var MethodBuilderInterface
     */
    protected $methodBuilder;

    /**
     * Builder constructor.
     *
     * @param \Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Relations\Template\MethodBuilderInterface $methodBuilder
     */
    public function __construct(MethodBuilderInterface $methodBuilder)
    {
        $this->methodBuilder = new $methodBuilder;
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
            $relations .= $this->methodBuilder->belongsToTemplate($relatedModel, $index);

        return [
            Constants::TABLE_NAME_TEMPLATE_KEY => ModelHelpers::modelNameToTableName($model),
            Constants::CLASS_NAME_TEMPLATE_KEY => $migrationClass,
            Constants::RELATIONS_TEMPLATE_KEY  => $relations,
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
            Constants::RELATIONS_TEMPLATE_KEY  => $this->methodBuilder->belongsToManyTemplate($model, $relatedModel),
        ];
    }

}