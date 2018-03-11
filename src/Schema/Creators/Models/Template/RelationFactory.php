<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\Template;

use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Constants as RelationConstants;

/**
 * Class Relation
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\Template
 */
class RelationFactory
{

    /**
     * @param string $relation
     * @param string $model
     * @param string $relatedModel
     *
     * @return \Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\Template\RelationBuilderInterface
     */
    public function makeBuilder(string $relation, string $model, string $relatedModel): RelationBuilderInterface
    {
        return ($relation == RelationConstants::BELONGS_TO_MANY) ?
            new ManyToManyRelation($relation, $model, $relatedModel) : new OnesRelation($relation, $relatedModel);
    }

}