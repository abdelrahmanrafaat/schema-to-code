<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Getters;

use Abdelrahmanrafaat\SchemaToCode\Schema\Getters\Local\GetterFactory as LocalGetterFactory;

/**
 * Class Getter
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Getters
 */
class Getter
{
    /**
     * @param array $getterOptions
     *
     * @return string
     */
    public function get(array $getterOptions): string
    {
        $schemaGetter = $this->makeGetter($getterOptions);
        return $schemaGetter->get();
    }

    /**
     * @param array $options
     *
     * @return \Abdelrahmanrafaat\SchemaToCode\Schema\Getters\GetterInterface
     */
    protected function makeGetter(array $options): GetterInterface
    {
        return (new LocalGetterFactory)->make($options);
    }

}
