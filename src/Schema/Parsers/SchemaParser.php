<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Parsers;

use Abdelrahmanrafaat\SchemaToCode\Helpers\ArrayHelpers;
use Abdelrahmanrafaat\SchemaToCode\Helpers\IntegersHelpers;
use Abdelrahmanrafaat\SchemaToCode\Helpers\StringHelpers;
use Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Parsers\EmptySchema;
use Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Parsers\NotEvenLinesCount;

/**
 * Class SchemaParser
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Parsers
 */
class SchemaParser implements SchemaParserInterface
{
    /** @var \Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\ModelsParserInterface */
    protected $modelsParser;

    /** @var \Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\RelationsParserInterface */
    protected $relationsParser;

    /** @var \Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\ModelsManagerInterface */
    protected $modelsManager;

    /**
     * SchemaParser constructor.
     *
     * @param \Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\ModelsParserInterface    $modelsParser
     * @param \Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\RelationsParserInterface $relationsParser
     * @param \Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\ModelsManagerInterface   $modelsManager
     */
    public function __construct(ModelsParserInterface $modelsParser, RelationsParserInterface $relationsParser, ModelsManagerInterface $modelsManager)
    {
        $this->modelsParser    = $modelsParser;
        $this->relationsParser = $relationsParser;
        $this->modelsManager   = $modelsManager;
    }

    /**
     * Contains the logic of parsing the schema
     *  -parse & extract models from modelsLine
     *  -parse & extract relations from relationsLine using the extracted models in the previous line
     *  -Group the relations by models
     *
     * @param string $schema
     *
     * @return array
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Parsers\EmptySchema
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Parsers\NotEvenLinesCount
     */
    public function parse(string $schema): array
    {
        $schemaLines = $this->toSanitizedLines($schema);
        $this->validate($schemaLines);

        /**
         * The Schema has even number of lines one for Models and one for Relations
         * isModelLine flag was added to identify what current line we are iterating through
         */
        $isModelsLine = true;

        $lastParsedModels = [];
        $relations        = [];
        foreach ($schemaLines as $lineIndex => $line) {
            $lineNumber = $lineIndex + 1;

            if ($isModelsLine)
                $lastParsedModels = $this->modelsParser->parse($line, $lineNumber);

            if (!$isModelsLine)
                $relations[] = $this->relationsParser->parse($line, $lineNumber, $lastParsedModels);

            $isModelsLine = !$isModelsLine;
        }

        return $this->modelsManager->groupByModels($relations);
    }

    /**
     * Converts the string schema into an array and filter empty lines from the array
     *
     * @param string $schema
     *
     * @return array
     */
    protected function toSanitizedLines(string $schema): array
    {
        return ArrayHelpers::filterEmptyLines(StringHelpers::toLinesArray($schema));
    }

    /**
     * @param array $schemaLines
     *
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Parsers\EmptySchema
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Parsers\NotEvenLinesCount
     */
    protected function validate(array $schemaLines): void
    {
        $linesCount = count($schemaLines);

        if ($linesCount == 0)
            Throw new EmptySchema;

        if (!IntegersHelpers::isEven($linesCount))
            Throw new NotEvenLinesCount;
    }

}