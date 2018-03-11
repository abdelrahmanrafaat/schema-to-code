<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\Template;

use Illuminate\Console\DetectsApplicationNamespace;
use Abdelrahmanrafaat\SchemaToCode\Helpers\ModelHelpers;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Constants as TemplateConstants;

/**
 * Class Builder
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\Template
 */
class Builder implements BuilderInterface
{
    use DetectsApplicationNamespace;

    protected $relationBuilder;

    public function __construct(Relation $relationBuilder)
    {
        $this->relationBuilder = $relationBuilder;
    }

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
            foreach ($relatedModels as $relatedModel)
                $relationsTemplate .= $this->relationBuilder->getBuilder($relation, $model, $relatedModel)->getTemplate();

        return $relationsTemplate;
    }

}