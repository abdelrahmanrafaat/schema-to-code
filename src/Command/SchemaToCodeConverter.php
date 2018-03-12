<?php

namespace Abdelrahmanrafaat\SchemaToCode\Command;

use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Relations\Template\Builder as MigrationsTemplateBuilder;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Relations\Creator as RelationsCreator;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Tables\Template\Builder;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\Template\Builder as ModelsTemplateBuilder;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\Template\RelationFactory as ModelRelationBuilder;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Tables\Creator as TablesCreator;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\Relations\Template\MethodBuilder;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\Aggregators\RelationsAggregator;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Migrations\MigrationsCreator;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\RelationsSymbolsParser;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\Models\ModelsCreator;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\RelationsParser;
use Abdelrahmanrafaat\SchemaToCode\Schema\Creators\CodeCreator;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\ModelsManager;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\ModelsParser;
use Abdelrahmanrafaat\SchemaToCode\Schema\Parsers\SchemaParser;
use Abdelrahmanrafaat\SchemaToCode\Schema\Reporters\Reporter;
use Abdelrahmanrafaat\SchemaToCode\Schema\Getters\Getter;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Console\Command;

class SchemaToCodeConverter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'convert:schema-to-code 
        {path : path starting from project root directory}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Converts DB schema to code (models and migrations)';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Parsers\EmptySchema
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Parsers\NotEvenLinesCount
     */
    public function handle()
    {
        $schema = (new Getter)->get($this->arguments());

        $parsedSchema = (new SchemaParser(
            new ModelsParser, new RelationsParser(new RelationsSymbolsParser, new RelationsAggregator), new ModelsManager
        ))->parse($schema);

        $modelsCreator = new ModelsCreator(
            new Filesystem, new ModelsTemplateBuilder(new ModelRelationBuilder)
        );

        $tablesTemplateBuilder    = new Builder;
        $tablesCreator            = new TablesCreator(new Filesystem, $tablesTemplateBuilder);
        $relationsTemplateBuilder = new MigrationsTemplateBuilder(new MethodBuilder);
        $relationsCreator         = new RelationsCreator(new Filesystem, $relationsTemplateBuilder);
        $migrationsCreator        = new MigrationsCreator($tablesCreator, $relationsCreator);

        (new CodeCreator($modelsCreator, $migrationsCreator))->create($parsedSchema);

        $reporter = new Reporter($this);
        $reporter->generateMigrationsReport(MigrationsCreator::getCreatedMigrations());
        $reporter->generateModelsReport(ModelsCreator::getCreatedModels());

    }
}
