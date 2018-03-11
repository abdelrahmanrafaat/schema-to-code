<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\Template;

use Abdelrahmanrafaat\SchemaToCode\Helpers\ModelHelpers;
use Abdelrahmanrafaat\SchemaToCode\Helpers\StringHelpers;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Constants as RelationConstants;

/**
 * Class OnesRelation
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\Template
 */
class OnesRelation implements RelationBuilderInterface
{
    /**
     * @var string
     */
    protected $relation;
    /**
     * @var string
     */
    protected $relatedModel;

    /**
     * OnesRelation constructor.
     *
     * @param string $relation
     * @param string $relatedModel
     */
    public function __construct(string $relation, string $relatedModel)
    {
        $this->relation     = $relation;
        $this->relatedModel = $relatedModel;
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        $tab        = StringHelpers::tab();
        $methodName = ModelHelpers::modelNameToMethodName($this->relatedModel, $this->relation == RelationConstants::HAS_MANY);
        $newLine    = PHP_EOL;

        return "{$tab}public function {$methodName}(){$newLine}" .
               "{$tab}{{$newLine}" .
               "{$tab}{$tab}return \$this->{$this->relation}({$this->relatedModel}::class);{$newLine}" .
               "{$tab}}{$newLine}{$newLine}";
    }
}