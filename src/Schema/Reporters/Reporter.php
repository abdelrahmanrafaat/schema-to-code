<?php

namespace Abdelrahmanrafaat\SchemaToCode\Schema\Reporters;

use Illuminate\Console\Command;

/**
 * Class Migrations
 *
 * @package Abdelrahmanrafaat\SchemaToCode\Schema\Reporters
 */
class Reporter implements ReportableInterface
{
    /**
     * @var \Illuminate\Console\Command
     */
    protected $command;

    /**
     * Migrations constructor.
     *
     * @param \Illuminate\Console\Command $command
     */
    public function __construct(Command $command)
    {
        $this->command = $command;
    }

    /**
     * @param array $createdMigrations
     */
    public function generateMigrationsReport(array $createdMigrations): void
    {
        $this->command->table(['Created Migrations ...'], $this->mapArrayToMultiArray($createdMigrations));
    }

    /**
     * @param array $createdModels
     */
    public function generateModelsReport(array $createdModels): void
    {
        $this->command->table(['Created Models ...'], $this->mapArrayToMultiArray($createdModels));
    }

    /**
     * @param array $array
     *
     * @return array
     */
    protected function mapArrayToMultiArray(array $array): array
    {
        return array_map(
            function ($item) {
                return [$item];
            }, $array
        );
    }

}