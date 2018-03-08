<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\Template;

use Abdelrahmanrafaat\SchemaToCode\Helpers\MigrationHelpers;
use Abdelrahmanrafaat\SchemaToCode\Helpers\ModelHelpers;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Constants as TemplateConstants;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\ModelsCreator;
use \Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Constants as RelationConstants;
use Illuminate\Console\DetectsApplicationNamespace;

/**
 * Class Builder
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\Template
 */
class Builder implements BuilderInterface
{
    use DetectsApplicationNamespace;

    /**
     * @param string $model
     * @param array  $relations
     *
     * @return array
     */
    public function createModelTemplate(string $model, array $relations): array
    {
        return [
            TemplateConstants::CLASS_NAME_TEMPLATE_KEY  => $model,
            TemplateConstants::TABLE_NAME_TEMPLATE_KEY  => ModelHelpers::modelNameToTableName($model),
            TemplateConstants::RELATIONS_TEMPLATE_KEY   => $this->buildRelationsTemplate($model, $relations),
            TemplateConstants::NAME_SPACE_TEMPLATE_KEYS => rtrim($this->getAppNamespace(), '\\'),
        ];
    }

    /**
     * @param string $model
     * @param array  $relations
     *
     * @return string
     */
    protected function buildRelationsTemplate(string $model, array $relations): string
    {
        $relationsTemplate = '';
        foreach ($relations as $relation => $relatedModels)
            $relationsTemplate .= $this->getRelationTemplate($relation, $model, $relatedModels);

        return $relationsTemplate;
    }

    /**
     * @param string $relation
     * @param string $model
     * @param array  $relatedModels
     *
     * @return string
     */
    protected function getRelationTemplate(string $relation, string $model, array $relatedModels): string
    {
        $template = '';
        foreach ($relatedModels as $index => $relatedModel) {
            if ($relation == RelationConstants::BELONGS_TO_MANY) {
                $template .= $this->belongsToManyTemplate($relation, $model, $relatedModel, $index != 0);
                continue;
            }

            $template .= $this->relationTemplate($relation, $relatedModel, $index != 0);
        }

        return $template;
    }

    /**
     * @param string $relation
     * @param string $relatedModel
     * @param bool   $withIndentation
     *
     * @return string
     */
    protected function relationTemplate(string $relation, string $relatedModel, bool $withIndentation = false): string
    {
        $tab         = chr(9);
        $methodName  = ModelHelpers::modelNameToMethodName($relatedModel, $relation == RelationConstants::HAS_MANY);
        $newLine     = PHP_EOL;
        $indentation = ($withIndentation) ? $tab : '';

        return "{$indentation}public function {$methodName}(){$newLine}" .
               "{$tab}{{$newLine}" .
               "{$tab}{$tab}return \$this->{$relation}({$relatedModel}::class);{$newLine}" .
               "{$tab}}{$newLine}{$newLine}";
    }

    /**
     * @param string $relation
     * @param string $model
     * @param string $relatedModel
     * @param bool   $withIndentation
     *
     * @return string
     */
    protected function belongsToManyTemplate(string $relation, string $model, string $relatedModel, bool $withIndentation = false): string
    {
        $tab                    = chr(9);
        $methodName             = ModelHelpers::modelNameToMethodName($model, true);
        $pivotTable             = MigrationHelpers::manyToManyTableName($model, $relatedModel);
        $modelForeignKey        = ModelHelpers::modelNameToForeignKey($model);
        $relatedModelForeignKey = ModelHelpers::modelNameToForeignKey($relatedModel);
        $newLine                = PHP_EOL;
        $indentation            = ($withIndentation) ? $tab : '';

        return "{$indentation}public function {$methodName}(){$newLine}" .
               "{$tab}{{$newLine}" .
               "{$tab}{$tab}return \$this->{$relation}({$model}::class,'{$pivotTable}','{$relatedModelForeignKey}','{$modelForeignKey}')->withTimestamps();{$newLine}" .
               "{$tab}}{$newLine}{$newLine}";
    }

}