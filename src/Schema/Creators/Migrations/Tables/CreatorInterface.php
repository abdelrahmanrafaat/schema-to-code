<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Tables;

/**
 * Interface CreatorInterface
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Tables
 */
interface CreatorInterface
{
    /**
     * @param string $model
     */
    public function createTable(string $model): void;
}