<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Parsers;

use Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Constants;
use Exception;

/**
 * Class InvalidModelsSyntax
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Parsers
 */
class InvalidModelsSyntax extends Exception
{
    /**
     * InvalidModelsSyntax constructor.
     *
     * @param int $lineNumber
     */
    public function __construct(int $lineNumber)
    {
        parent::__construct(
            sprintf(Constants::INVALID_MODEL_SYNTAX_MESSAGE, $lineNumber),
            Constants::INVALID_MODEL_SYNTAX_CODE
        );
    }

}