<?php


namespace Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Parsers;

use Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Constants;
use Exception;

/**
 * Class NotEvenLinesCount
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Parsers
 */
class NotEvenLinesCount extends Exception
{
    /**
     * NotEvenLinesCount constructor.
     */
    public function __construct()
    {
        parent::__construct(
            Constants::NOT_EVEN_LINES_COUNT_MESSAGE,
            Constants::NOT_EVEN_LINES_COUNT_CODE
        );
    }
}