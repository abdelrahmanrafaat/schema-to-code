<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Parsers;

use Abdelrahmanrafaat\SchemaToCode\Helpers\ArrayHelpers;
use Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Constants;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Constants as ParsingConstants;
use Exception;

/**
 * Class InvalidRelationsSyntax
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Parsers
 */
class InvalidRelationsSyntax extends Exception
{
    /**
     * InvalidRelationsSyntax constructor.
     *
     * @param int $lineNumber
     */
    public function __construct(int $lineNumber)
    {
        $validRelationFormats = ArrayHelpers::commaImplode(ParsingConstants::RELATION_SYMBOLS);

        parent::__construct(
            sprintf(Constants::INVALID_RELATION_SYNTAX_MESSAGE, $lineNumber, $validRelationFormats),
            Constants::INVALID_RELATION_SYNTAX_CODE
        );
    }
}