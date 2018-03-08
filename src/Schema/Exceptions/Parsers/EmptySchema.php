<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Parsers;

use Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Constants;
use Exception;

/**
 * Class EmptySchema
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Parsers
 */
class EmptySchema extends Exception
{
    /**
     * EmptySchema constructor.
     */
    public function __construct()
    {
        parent::__construct(
            Constants::EMPTY_SCHEMA_MESSAGE,
            Constants::EMPTY_SCHEMA_CODE
        );
    }
}