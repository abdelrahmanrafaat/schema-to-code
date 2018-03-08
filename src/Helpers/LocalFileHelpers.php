<?php

namespace Abdelrahmanrafaat\SchemaToCode\Helpers;

use Illuminate\Filesystem\Filesystem;

/**
 * Class LocalFileHelpers
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Helpers
 */
class LocalFileHelpers
{
    /**
     * @var string
     */
    public $path;

    /**
     * LocalFileHelpers constructor.
     *
     * @param string $pathFromProjectRoot
     */
    public function __construct(string $pathFromProjectRoot)
    {
        $this->path = $this->fullPath($pathFromProjectRoot);
    }

    /**
     * @param string $pathFromProjectRoot
     *
     * @return string
     */
    protected function fullPath(string $pathFromProjectRoot): string
    {
        $rootDirectory = base_path();

        return $rootDirectory . '/' . StringHelpers::trimSlashes($pathFromProjectRoot);
    }

    /**
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getContents(): string
    {
        return (new Filesystem())->get($this->path);
    }

    /**
     * @return bool
     */
    public function exists(): bool
    {
        return (new Filesystem())->exists($this->path);
    }

    /**
     * @return bool
     */
    public function isFile(): bool
    {
        return (new Filesystem())->isFile($this->path);
    }

    /**
     * @return bool
     */
    public function isReadable(): bool
    {
        return (new Filesystem())->isReadable($this->path);
    }

    /**
     * @return bool
     */
    public function isTxt(): bool
    {
        return (new Filesystem())->extension($this->path) === 'txt';
    }
}
