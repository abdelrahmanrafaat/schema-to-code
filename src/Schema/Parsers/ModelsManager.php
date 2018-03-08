<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Parsers;

/**
 * Class ModelsManager
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Parsers
 */
class ModelsManager implements ModelsManagerInterface
{
    /**
     * @var array Grouping Result
     */
    protected $models = [];

    /**
     * Groups relations by models
     *
     * @param array $relations
     *
     * @return array
     */
    public function groupByModels(array $relations): array
    {
        foreach ($relations as $relationModels) {
            foreach ($relationModels as $model => $relationDetails) {
                foreach ($relationDetails as $method => $otherModel)
                    $this->addRelation($model, $method, $otherModel);
            }
        }

        return $this->models;
    }

    /**
     * @param string $model
     * @param string $method
     * @param string $otherModel
     */
    protected function addRelation(string $model, string $method, string $otherModel): void
    {
        if (!isset($this->models[$model]))
            $this->models[$model] = $this->getRelationsSkeleton();

        $this->models[$model][$method][] = $otherModel;
    }

    /**
     * @return array
     */
    protected function getRelationsSkeleton(): array
    {
        return [
            Constants::HAS_ONE         => [],
            Constants::BELONGS_TO      => [],
            Constants::HAS_MANY        => [],
            Constants::BELONGS_TO_MANY => [],
        ];
    }
}