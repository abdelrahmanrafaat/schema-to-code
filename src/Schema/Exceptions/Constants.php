<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions;

/**
 * Exceptions Constants Class
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions
 */
class Constants
{
    const SCHEMA_NOT_FOUND_MESSAGE = 'Schema file was not found at : %s';
    const SCHEMA_NOT_FOUND_CODE    = 401;

    const SCHEMA_IS_NOT_FILE_MESSAGE = 'Schema Should be a file';
    const SCHEMA_IS_NOT_FILE_CODE    = 402;

    const SCHEMA_IS_NOT_READABLE_FILE_MESSAGE = 'Schema File Should be a readable file';
    const SCHEMA_IS_NOT_READABLE_FILE_CODE    = 403;

    const SCHEMA_EXTENSION_NOT_TXT_MESSAGE = 'Schema File Should be a .txt file';
    const SCHEMA_EXTENSION_NOT_TXT_CODE    = 404;

    const EMPTY_SCHEMA_MESSAGE = 'Schema can not be empty';
    const EMPTY_SCHEMA_CODE    = 405;

    const NOT_EVEN_LINES_COUNT_MESSAGE = 'Schema must have even number of lines(one for models and other for relations)';
    const NOT_EVEN_LINES_COUNT_CODE    = 406;

    const INVALID_MODEL_SYNTAX_MESSAGE = 'Invalid models syntax in line %s';
    const INVALID_MODEL_SYNTAX_CODE    = 407;

    const INVALID_RELATION_SYNTAX_MESSAGE = 'Invalid relations syntax in line %s' .
                                            PHP_EOL . 'Relations should be in one of the following formats %s';
    const INVALID_RELATION_SYNTAX_CODE    = 408;

}