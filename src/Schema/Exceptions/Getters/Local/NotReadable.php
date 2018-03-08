<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local;

use Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Constants;
use Exception;

/**
 * Class NotReadable
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local
 */
class NotReadable extends Exception
{
    /**
     * NotReadable constructor.
     */
    public function __construct()
    {
        parent::__construct(
            Constants::SCHEMA_IS_NOT_READABLE_FILE_MESSAGE,
            Constants::SCHEMA_IS_NOT_READABLE_FILE_CODE
        );
    }

}