<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local;

use Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Constants;
use Exception;

/**
 * Class ExtensionNotTxt
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local
 */
class ExtensionNotTxt extends Exception
{
    /**
     * ExtensionNotTxt constructor.
     */
    public function __construct()
    {
        parent::__construct(
            Constants::SCHEMA_EXTENSION_NOT_TXT_MESSAGE,
            Constants::SCHEMA_EXTENSION_NOT_TXT_CODE
        );
    }

}
