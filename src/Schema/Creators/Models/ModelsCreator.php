<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models;

use Abdelrahmanrafaat\SchemaToCode\Helpers\ModelHelpers;
use Abdelrahmanrafaat\SchemaToCode\Helpers\StringHelpers;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\Template\BuilderInterface;
use Illuminate\Filesystem\Filesystem;

class ModelsCreator implements ModelsCreatorInterface
{
    /**
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $fileSystem;
    /**
     * @var \Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\Template\BuilderInterface
     */
    protected $templatesBuilder;
    /**
     * @var array
     */
    protected static $createdModels = [];

    /**
     * ModelsCreator constructor.
     *
     * @param \Illuminate\Filesystem\Filesystem                                                $fileSystem
     * @param \Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\Template\BuilderInterface $templatesBuilder
     */
    public function __construct(Filesystem $fileSystem, BuilderInterface $templatesBuilder)
    {
        $this->fileSystem       = $fileSystem;
        $this->templatesBuilder = $templatesBuilder;
    }

    /**
     * @param string $model
     * @param array  $relations
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function create(string $model, array $relations): void
    {
        $templates = $this->templatesBuilder->createModelTemplate($model, $relations);

        $stub      = StringHelpers::populateStub($this->fileSystem, ModelHelpers::createModelStubPath(), $templates);
        $modelPath = ModelHelpers::getModelPath($model);

        $this->fileSystem->put($modelPath, $stub);
        self::addCreatedModel($model);
    }

    /**
     * @return string
     */
    public static function stubsDirectoryPath(): string
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'stubs';
    }

    /**
     * @param string $model
     */
    public function addCreatedModel(string $model): void
    {
        self::$createdModels[] = $model;
    }

    /**
     * @return array
     */
    public static function getCreatedModels(): array
    {
        return self::$createdModels;
    }

    /**
     * @return void
     */
    public static function resetCreatedModels(): void
    {
        self::$createdModels = [];
    }
}