<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Parsers;

use Abdelrahmanrafaat\SchemaToCode\Helpers\ArrayHelpers;
use Abdelrahmanrafaat\SchemaToCode\Helpers\ModelHelpers;
use Abdelrahmanrafaat\SchemaToCode\Helpers\StringHelpers;
use Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Parsers\InvalidModelsSyntax;

/**
 * Class ModelsParser
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Parsers
 */
class ModelsParser implements ModelsParserInterface
{
    /**
     * @param string $modelsLine
     * @param int    $lineNumber
     *
     * @return array
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Parsers\InvalidModelsSyntax
     */
    public function parse(string $modelsLine, int $lineNumber): array
    {
        $models = ModelHelpers::normalizedModelsMap(StringHelpers::colonExplode($modelsLine));
        $this->validate($models, $lineNumber);

        return $models;
    }

    /**
     * @param array $models
     * @param int   $lineNumber
     *
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Parsers\InvalidModelsSyntax
     */
    protected function validate(array $models, int $lineNumber): void
    {
        if (count($models) != Constants::MODELS_COUNT_IN_A_LINE)
            throw new InvalidModelsSyntax($lineNumber);

        foreach ($models as $model)
            if (empty($model)) throw new InvalidModelsSyntax($lineNumber);
    }
}