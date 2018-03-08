<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Getters\Local;

use Abdelrahmanrafaat\SchemaToCode\Helpers\LocalFileHelpers;
use Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local\ExtensionNotTxt;
use Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local\NotFile;
use Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local\NotFound;
use Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local\NotReadable;
use Abdelrahmanrafaat\SchemaToCode\Schema\Getters\GetterInterface;

/**
 * Class Getter
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Getters\Local
 */
class Getter implements GetterInterface
{
    /**
     * @var \Abdelrahmanrafaat\SchemaToCode\Helpers\LocalFileHelpers
     */
    protected $localFileHelpers;

    /**
     * Getter constructor.
     *
     * @param \Abdelrahmanrafaat\SchemaToCode\Helpers\LocalFileHelpers $localFileHelpers
     */
    public function __construct(LocalFileHelpers $localFileHelpers)
    {
        $this->localFileHelpers = $localFileHelpers;
    }

    /**
     * @return string
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local\ExtensionNotTxt
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local\NotFile
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local\NotFound
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local\NotReadable
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function get(): string
    {
        $this->validate();

        return $this->localFileHelpers->getContents();
    }

    /**
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local\ExtensionNotTxt
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local\NotFile
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local\NotFound
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local\NotReadable
     */
    public function validate(): void
    {
        if (!$this->localFileHelpers->exists())
            throw new NotFound($this->localFileHelpers->path);

        if (!$this->localFileHelpers->isFile())
            throw new NotFile();

        if (!$this->localFileHelpers->isReadable())
            throw new NotReadable();

        if (!$this->localFileHelpers->isTxt())
            throw new ExtensionNotTxt();
    }

}
