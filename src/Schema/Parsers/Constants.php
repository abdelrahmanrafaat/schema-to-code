<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Parsers;

/**
 * Class Constants
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Parsers
 */
class Constants
{
    const MANY_SYMBOL = 'm';
    const ONE_SYMBOL  = '1';

    const ONE_TO_ONE_SYMBOL   = self::ONE_SYMBOL . ':' . self::ONE_SYMBOL;
    const ONE_TO_MANY_SYMBOL  = self::ONE_SYMBOL . ':' . self::MANY_SYMBOL;
    const MANY_TO_ONE_SYMBOL  = self::MANY_SYMBOL . ':' . self::ONE_SYMBOL;
    const MANY_TO_MANY_SYMBOL = self::MANY_SYMBOL . ':' . self::MANY_SYMBOL;

    const RELATION_SYMBOLS = [
        self::ONE_TO_ONE_SYMBOL,
        self::ONE_TO_MANY_SYMBOL,
        self::MANY_TO_MANY_SYMBOL,
        self::MANY_TO_ONE_SYMBOL,
    ];

    const MODELS_COUNT_IN_A_LINE            = 2;
    const RELATIONS_SYMBOLS_COUNT_IN_A_LINE = 2;

    const HAS_ONE         = 'hasOne';
    const HAS_MANY        = 'hasMany';
    const BELONGS_TO      = 'belongsTo';
    const BELONGS_TO_MANY = 'belongsToMany';
}