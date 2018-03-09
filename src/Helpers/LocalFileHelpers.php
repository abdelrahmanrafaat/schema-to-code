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
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $filesystem;

    /**
     * LocalFileHelpers constructor.
     *
     * @param string $pathFromProjectRoot
     */
    public function __construct(Filesystem $filesystem, string $pathFromProjectRoot)
    {
        $this->path       = $this->fullPath($pathFromProjectRoot);
        $this->filesystem = $filesystem;
    }

    /**
     * @param string $pathFromProjectRoot
     *
     * @return string
     */
    protected function fullPath(string $pathFromProjectRoot): string
    {
        $rootDirectory = base_path();

        return $rootDirectory . DIRECTORY_SEPARATOR . StringHelpers::trimSlashes($pathFromProjectRoot);
    }

    /**
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getContents(): string
    {
        return $this->filesystem->get($this->path);
    }

    /**
     * @return bool
     */
    public function exists(): bool
    {
        return $this->filesystem->exists($this->path);
    }

    /**
     * @return bool
     */
    public function isFile(): bool
    {
        return $this->filesystem->isFile($this->path);
    }

    /**
     * @return bool
     */
    public function isReadable(): bool
    {
        return $this->filesystem->isReadable($this->path);
    }

    /**
     * @return bool
     */
    public function isTxt(): bool
    {
        return $this->filesystem->extension($this->path) === 'txt';
    }
}
