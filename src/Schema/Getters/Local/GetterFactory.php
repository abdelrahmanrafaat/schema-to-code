<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Getters\Local;

use Abdelrahmanrafaat\SchemaToCode\Helpers\LocalFileHelpers;
use Abdelrahmanrafaat\SchemaToCode\Schema\Getters\GetterInterface;
use Abdelrahmanrafaat\SchemaToCode\Schema\Getters\Local\Getter as LocalGetter;
use Illuminate\Filesystem\Filesystem;

/**
 * Class GetterFactory
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Getters\Local
 */
class GetterFactory
{
    /**
     * @param array $options
     *
     * @return \Abdelrahmanrafaat\SchemaToCode\Schema\Getters\GetterInterface
     */
    public function make(array $options): GetterInterface
    {
        $localFileHelper = new LocalFileHelpers(new Filesystem, $options['path']);

        return new LocalGetter($localFileHelper);
    }
}