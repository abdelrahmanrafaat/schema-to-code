<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Getters;

/**
 * Interface GetterInterface
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Getters
 */
Interface GetterInterface
{
    /**
     * @return string
     */
    public function get(): string;

    /**
     * @return void
     */
    public function validate(): void;
}