<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local;

use Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Constants;
use Exception;

/**
 * Class NotFile
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local
 */
class NotFile extends Exception
{
    /**
     * NotFile constructor.
     */
    public function __construct()
    {
        parent::__construct(
            Constants::SCHEMA_IS_NOT_FILE_MESSAGE,
            Constants::SCHEMA_IS_NOT_FILE_CODE
        );
    }

}