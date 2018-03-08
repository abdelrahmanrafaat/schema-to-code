<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local;

use Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Constants;
use Exception;

/**
 * Class NotFound
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local
 */
class NotFound extends Exception
{
    /**
     * NotFound constructor.
     *
     * @param string $path
     */
    public function __construct(string $path)
    {
        parent::__construct(
            sprintf(Constants::SCHEMA_NOT_FOUND_MESSAGE, $path),
            Constants::SCHEMA_NOT_FOUND_CODE
        );
    }

}