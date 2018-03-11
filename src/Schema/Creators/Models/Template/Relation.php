<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\Template;

use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Constants as RelationConstants;

class Relation
{
    public function getBuilder(string $relation, string $model, string $relatedModel): RelationBuilderInterface
    {
        return ($relation == RelationConstants::BELONGS_TO_MANY) ?
            new OnesRelation($relation, $relatedModel) : new ManyToManyRelation($relation, $model, $relatedModel);
    }

}